  <!-- Questions Table -->
                <table class="table table-bordered table-striped mt-4">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Question</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("./connection/include.php");
                        $sql = "SELECT question_id, question, description FROM questions";
                        $result = $connect->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["question_id"] . "</td><td>" . $row["question"] . "</td><td>" . $row["description"] . "</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No questions found</td></tr>";
                        }

                        $connect->close();
                        ?>
                    </tbody>
                </table>