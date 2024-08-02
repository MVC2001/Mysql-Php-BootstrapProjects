

                series.selected = selected = (selected === undefined) ?
                    !series.selected :
                    selected;

                if (series.checkbox) {
                    series.checkbox.checked = selected;
                }

                fireEvent(series, selected ? 'select' : 'unselect');
            },

            drawTracker: TrackerMixin.drawTrackerGraph
        });

    }(Highcharts));
    (function(H) {
        /**
         * (c) 2010-2017 Torstein Honsi
         *
         * License: www.highcharts.com/license
         */
        var Chart = H.Chart,
            each = H.each,
            inArray = H.inArray,
            isArray = H.isArray,
            isObject = H.isObject,
            pick = H.pick,
            splat = H.splat;


        /**
         * Allows setting a set of rules to apply for different screen or chart
         * sizes. Each rule specifies additional chart options.
         * 
         * @sample {highstock} stock/demo/responsive/ Stock chart
         * @sample highcharts/responsive/axis/ Axis
         * @sample highcharts/responsive/legend/ Legend
         * @sample highcharts/responsive/classname/ Class name
         * @since 5.0.0
         * @apioption responsive
         */

        /**
         * A set of rules for responsive settings. The rules are executed from
         * the top down.
         * 
         * @type {Array<Object>}
         * @sample {highcharts} highcharts/responsive/axis/ Axis changes
         * @sample {highstock} highcharts/responsive/axis/ Axis changes
         * @sample {highmaps} highcharts/responsive/axis/ Axis changes
         * @since 5.0.0
         * @apioption responsive.rules
         */

        /**
         * A full set of chart options to apply as overrides to the general
         * chart options. The chart options are applied when the given rule
         * is active.
         * 
         * A special case is configuration objects that take arrays, for example
         * [xAxis](#xAxis), [yAxis](#yAxis) or [series](#series). For these
         * collections, an `id` option is used to map the new option set to
         * an existing object. If an existing object of the same id is not found,
         * the item of the same indexupdated. So for example, setting `chartOptions`
         * with two series items without an `id`, will cause the existing chart's
         * two series to be updated with respective options.
         * 
         * @type {Object}
         * @sample {highstock} stock/demo/responsive/ Stock chart
         * @sample highcharts/responsive/axis/ Axis
         * @sample highcharts/responsive/legend/ Legend
         * @sample highcharts/responsive/classname/ Class name
         * @since 5.0.0
         * @apioption responsive.rules.chartOptions
         */

        /**
         * Under which conditions the rule applies.
         * 
         * @type {Object}
         * @since 5.0.0
         * @apioption responsive.rules.condition
         */

        /**
         * A callback function to gain complete control on when the responsive
         * rule applies. Return `true` if it applies. This opens for checking
         * against other metrics than the chart size, or example the document
         * size or other elements.
         * 
         * @type {Function}
         * @context Chart
         * @since 5.0.0
         * @apioption responsive.rules.condition.callback
         */

        /**
         * The responsive rule applies if the chart height is less than this.
         * 
         * @type {Number}
         * @since 5.0.0
         * @apioption responsive.rules.condition.maxHeight
         */

        /**
         * The responsive rule applies if the chart width is less than this.
         * 
         * @type {Number}
         * @sample highcharts/responsive/axis/ Max width is 500
         * @since 5.0.0
         * @apioption responsive.rules.condition.maxWidth
         */

        /**
         * The responsive rule applies if the chart height is greater than this.
         * 
         * @type {Number}
         * @default 0
         * @since 5.0.0
         * @apioption responsive.rules.condition.minHeight
         */

        /**
         * The responsive rule applies if the chart width is greater than this.
         * 
         * @type {Number}
         * @default 0
         * @since 5.0.0
         * @apioption responsive.rules.condition.minWidth
         */

        /**
         * Update the chart based on the current chart/document size and options for
         * responsiveness.
         */
        Chart.prototype.setResponsive = function(redraw) {
            var options = this.options.responsive,
                ruleIds = [],
                currentResponsive = this.currentResponsive,
                currentRuleIds;

            if (options && options.rules) {
                each(options.rules, function(rule) {
                    if (rule._id === undefined) {
                        rule._id = H.uniqueKey();
                    }

                    this.matchResponsiveRule(rule, ruleIds, redraw);
                }, this);
            }

            // Merge matching rules
            var mergedOptions = H.merge.apply(0, H.map(ruleIds, function(ruleId) {
                return H.find(options.rules, function(rule) {
                    return rule._id === ruleId;
                }).chartOptions;
            }));

            // Stringified key for the rules that currently apply.
            ruleIds = ruleIds.toString() || undefined;
            currentRuleIds = currentResponsive && currentResponsive.ruleIds;


            // Changes in what rules apply
            if (ruleIds !== currentRuleIds) {

                // Undo previous rules. Before we apply a new set of rules, we need to
                // roll back completely to base options (#6291).
                if (currentResponsive) {
                    this.update(currentResponsive.undoOptions, redraw);
                }

                if (ruleIds) {
                    // Get undo-options for matching rules
                    this.currentResponsive = {
                        ruleIds: ruleIds,
                        mergedOptions: mergedOptions,
                        undoOptions: this.currentOptions(mergedOptions)
                    };

                    this.update(mergedOptions, redraw);

                } else {
                    this.currentResponsive = undefined;
                }
            }
        };

        /**
         * Handle a single responsiveness rule
         */
        Chart.prototype.matchResponsiveRule = function(rule, matches) {
            var condition = rule.condition,
                fn = condition.callback || function() {
                    return (
                        this.chartWidth <= pick(condition.maxWidth, Number.MAX_VALUE) &&
                        this.chartHeight <=
                        pick(condition.maxHeight, Number.MAX_VALUE) &&
                        this.chartWidth >= pick(condition.minWidth, 0) &&
                        this.chartHeight >= pick(condition.minHeight, 0)
                    );
                };

            if (fn.call(this)) {
                matches.push(rule._id);
            }

        };

        /**
         * Get the current values for a given set of options. Used before we update
         * the chart with a new responsiveness rule.
         * TODO: Restore axis options (by id?)
         */
        Chart.prototype.currentOptions = function(options) {

            var ret = {};

            /**
             * Recurse over a set of options and its current values,
             * and store the current values in the ret object.
             */
            function getCurrent(options, curr, ret, depth) {
                var i;
                H.objectEach(options, function(val, key) {
                    if (!depth && inArray(key, ['series', 'xAxis', 'yAxis']) > -1) {
                        val = splat(val);

                        ret[key] = [];

                        // Iterate over collections like series, xAxis or yAxis and map
                        // the items by index.
                        for (i = 0; i < val.length; i++) {
                            if (curr[key][i]) { // Item exists in current data (#6347)
                                ret[key][i] = {};
                                getCurrent(
                                    val[i],
                                    curr[key][i],
                                    ret[key][i],
                                    depth + 1
                                );
                            }
                        }
                    } else if (isObject(val)) {
                        ret[key] = isArray(val) ? [] : {};
                        getCurrent(val, curr[key] || {}, ret[key], depth + 1);
                    } else {
                        ret[key] = curr[key] || null;
                    }
                });
            }

            getCurrent(options, this.options, ret, 0);
            return ret;
        };

    }(Highcharts));
    return Highcharts
}));
                                     $
����Ϫ�09%�#U��5�$��&�V��"/��J'd�uđ�����U�7�.ؑvj����.+bJxK�����򊂘L:ب(�m��ԏo���R��X�M�vr[On�VoZ:�h��q�\�$p<�~v
h6et���Z�'8P��l3�VQ�'��_�E�'��̲���ݜ�xm�+&>�ngQ�,T<�˜�&���4���7���n��3�]&3��;���ն∌@�zx�%
U���W��
`2��/#<��ԃ�5$�Ŵ:�]n/nm+]މ$c����.A`[,���ŉ�DN糲;O@Th�:ʩ3��Y����;f���
7�p�{�ڢҠn�FR��z_!*E�n��I!<��"�6��y�j2���Aj����w��Mi�С%�V1:=��
�~:sw4	��ʮ<�4;Lk��0�)|��U��ݦe�2�?K�̂�Ë�O,�y�g*�_}�/(Ov��l�����DǕ�g��|�z.�����DUa�kƵN����8��ai������Fc���)�_u@�s; 4�\�*%�b��v�$�40�N�5�Y��>6z�OVre��
��ʴ��6_FaOٯ�8��]���=L�NO�
Q��@�c�Оc`zs�]c�q��V=A
�m���6�����d�G�3Zi�e~�J�RGTNy�+#�T%��Q�̱�u_rcHv
��2�d�9&س��0ʣ��ak4��Ҏ��,b
�4�I|.[�o��W��A�z梧�gk�� NN�4ZN�Vy�./��SqZe�R<{s����Fi�fĤ�鴞~i$��֩�׿��l�����*;���_fFIAӗM�C"��)G�A&�2����rD��B�͐�J&�9^'-h��Pt��O^�B��{�ţz�[A/O�ON��#z�J]��l�b�i����׺�u/x��b?�Cm�D���@5}ng�כ���� P^8剅�S5Rݝ��z�*�ò��5t_4U�'�i�q{*���0��JD�Hd¥76l�ʷ#<�0��S�M��F�I�ȓ�Md��Kk\~�yc
u[�� ˖��%�@W@ч�hȷ�Î+y�Pt�D~��'�Y��oE�[A'���Yx�1���((%�ތʃ-=�ʠ��;�S.��*�����T��/�����<s�$t����o�6�W�1��
���[ڳc�g�'I'�d��_��(3���4��{Cg�����a��})�x]gjܬ�n������ceϟ�{���Hs���ja���]QF��a�� W����;E�0�?�\j��)��j���+<EP1s5�&�UG�R;��H�9u��F;fR4�f%�U��-
�sŐ��d흕/8�7�`�Z���m�%F���E�)��H6
V���l��U@qu$7[��~����c)o����㕊%m�}~!�Q��H�+��t2&R0�;���]�&\�9�����B.	M7��|�0���g�~�s �5���X�ki��6  1]����Z9�y�/�@��X髋�i�\뢔��D��%
>B�4�f2����h�4�_��1����2+T�h��DUKh���w/Ѯ�V5�3U���{v�%�ucܫ&` ��P�=D����g������v���y��UQF��4� 	�<�cY��'�9(�
9�Z�	$qt �v��d�Ӽ��~��VW��/�_{���0�jxV��1���J?���E�5��Ozn[uk
[�
̆jW�6Ӽ���Zܛ�@U�@Q���G~
�sT����/��!Oה�|��.��V!�zYwSmR)埗EU�/��?7"��,
��"D���yKpOv���U�`��	@4���Gv�08"n��E�"Ǒq*�P���ROl��|q�~�ZBU�b|�D�f���Vq������_NFj�`;����R�>g�o%���j5�5�/�)�ѣ@,3w,ߜ�*"*r A�t:��eJ���f�oS{�K��HiC%_`b�2!����S�!�rM�M�<�!��k�]A7�8�i��x��>��	�����a�~�;Y�N#�8s����l$sl2��كF��W���	��ȴ��<�U �r���?w����.�
�s. 7J%��Z��a�&��+k��e3�+_���Z�M�P�Be�C�%��-�o��p�ӓ;c;4�NҌK�r�O���ȍ�A�)��9�>�6��0���Ϫ�EB���۾S�����i(	_6[�������KGv�d)���TX2��Ɔ-�L�p��F.`��z������(��2� ��͍F����ף	
q(�&Ǆ4� �HJTY!/��S[V:23�Dݔ��Πw�E/0*2��,���m9�Rϑ� ���Mx���E���h�ACQϾt<�G;�M���:<��pq�EL±ց�ThM",W�G�� �����hP!7����FQ4��N;� 4q<yw��|���"`C�b9O�lu(<��� ����E�Q����wB�\�[&�ؗz� �E�p2p� ��F�	���L�%�z���&��4�IS�*�٪,6�e3�2�/���&E�V
����r89���!�Bk��83�8g��6�"ճ�6��c��a�%�;�s�Qi���p�e��3�c���^�~D��'���-��c'/�0 �����8��K�^�`�XR�oM�\w����4D�(���4|���t�F���Y��l���@����m����тH�q s:᣺;�}�������j��`�m�	Z���,�W��7���ȣ�e)����>!�3�p���n�h�,��I��.|zH��Qe A, j�y5x�iƕ�r���]�X,��᣷���ko��BGȺn\Q,�&���0x����ɬt{����Q�E��Xu �3T��[���ܔ�(ސT���S��pi`7�����	էSG�i!�%!�!���&�.tyl]��jH5F�&\C����be�}�" �m�ކ̌)3�/�O7n��#{�{����䗕�	ld�lH���i#��������7�C�[��l$?�G�'	��O�WW�'����69"����H��Z��
�fI�2� C  5544S 7Y�w3�դ�@8"�8���������
!�qIW�WS�����ӆ)��W+��M��ļ��D*<�M�8���Iv兩2OpT�p��}W��b���#\�3`Ny�!͝�w\YMȏ�сj���	��%�~���j���>��p������;�g�|��y����۸��e�&xg��	�	)�Ǵ�;���Vr�(']w��]3����c?�٢�$є ��p��`-Z��P�ti��f�{��,0H�т�3#�1)n1�lT�9J�@߃�"-XSD�7-��A��ܪ%H�GV�+`Es�XLLye.8¾oz;'�$����Md���h[A�䒦��D9XFk7UW*}$�@C������.D��!;�ϸ��-X�ǔ�He���feή$x���
\5�M�#Q �N��xq�|Tx0SC�@%��D�܇侞Qb���I��+/L+a�'z�:�܅�EX(<��]���?��-�5��
�'�髯�¿��]��]2��rjz�B�92�9�z�_tR�a�U2w��]lm�Î�Wd{
��0�2���;U�IC���\�S���/2i�ް�pe��b��b����\�R^����q��H�]��������W,�<��-��s>p�%3u
i��8n�ԡx��*���歫-�?��)c<B�Nn�Lu>�7]pz�v�S�(0�bt��Ῐe.           �p��V�V  p��V�}    ..          �p��V�V  p��V�x    As r c   �� @������������  ����SRC         �p��V�V  p��V�}                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               