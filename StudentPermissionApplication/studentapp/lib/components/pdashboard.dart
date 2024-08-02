import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:doctorapointapp/components/login.dart';
import 'package:doctorapointapp/components/passwordResert.dart';
import 'package:doctorapointapp/components/session.dart';

class PDashboard extends StatefulWidget {
  const PDashboard({Key? key});

  @override
  State<PDashboard> createState() => _PDashboardState();
}

class _PDashboardState extends State<PDashboard> {
  String? selectedYearOfStudy;
  String? selectedSchool;
  String? selectedDept;
  DateTime? departingDate;
  DateTime? returningDate;
  bool dataSuccessfullyRegistered = false;

  TextEditingController controllerfullName = TextEditingController();
  TextEditingController controllerregNo = TextEditingController();
  TextEditingController controllerCourse = TextEditingController();
  TextEditingController controllerdays = TextEditingController();
  TextEditingController controllerdepartingOn = TextEditingController();
  TextEditingController controllerreturningOn = TextEditingController();
  TextEditingController controllerreasonFor = TextEditingController();
  TextEditingController controllerphoneNumber = TextEditingController();
  TextEditingController controllerdate = TextEditingController();

  final _formKey = GlobalKey<FormState>();

  List<String> yearOfStudyOptions = ['Year-one', 'Year-two', 'Year-three', 'Year-four', 'Year-five'];
  List<String> schoolOptions = ['SACEM', 'SSPSS', 'SERBI', 'SEES'];
  List<String> deptOptions = [
    'Building Economics',
    'Architecture',
    'Interior Design',
    'Geospatial Sciences and Technology',
    'Computer Systems and Mathematics',
    'Business Studies',
    'Land Management and Valuation',
    'Civil and Environmental Engineering',
    'Environmental Science and Management',
    'Urban and Regional Planning',
    'Economics and Social Studies',
  ];

  bool _loading = false; // Loading indicator variable

  void _showToast(String message) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Text(message),
        duration: Duration(seconds: 2),
      ),
    );
  }

  Future<void> sentRequest() async {
    if (!_formKey.currentState!.validate()) {
      return;
    }

    var url = Uri.parse("http://127.0.0.1/kazi1R/studentapp/apis/sentRequestForPermssion.php");

    setState(() {
      _loading = true; // Show loading indicator
    });

    try {
      var response = await http.post(url, body: {
        "fullName": controllerfullName.text,
        "regNo": controllerregNo.text,
        "yearOfStudy": selectedYearOfStudy ?? "",
        "Course": controllerCourse.text,
        "Dept": selectedDept ?? "",
        "School": selectedSchool ?? "",
        "days": controllerdays.text,
        "departingOn": controllerdepartingOn.text,
        "returningOn": controllerreturningOn.text,
        "reasonFor": controllerreasonFor.text,
        "phoneNumber": controllerphoneNumber.text,
        "date": controllerdate.text,
      });

      if (response.statusCode == 200) {
        var responseData = response.body;
        if (responseData == 'permission already exist') {
          _showToast('Permission already exists');
        } else if (responseData == 'Your Permission request have been sent successfully') {
          setState(() {
            dataSuccessfullyRegistered = true;
          });
          _showToast('Permission granted successfully');
          // Clear text controllers after successful submission
          controllerfullName.clear();
          controllerregNo.clear();
          controllerCourse.clear();
          controllerdays.clear();
          controllerdepartingOn.clear();
          controllerreturningOn.clear();
          controllerreasonFor.clear();
          controllerphoneNumber.clear();
          controllerdate.clear();
        } else {
          _showToast('Error: $responseData');
        }
      } else {
        throw Exception('Failed to add data');
      }
    } catch (e) {
      print('Error: $e');
      setState(() {
        dataSuccessfullyRegistered = false;
      });
      _showToast('Failed to add data. Please try again.');
    } finally {
      setState(() {
        _loading = false; // Hide loading indicator
      });
    }
  }

  Future<void> _selectDepartingDate(BuildContext context) async {
    final DateTime? picked = await showDatePicker(
      context: context,
      initialDate: DateTime.now(),
      firstDate: DateTime(1900),
      lastDate: DateTime.now(),
    );
    if (picked != null && picked != departingDate)
      setState(() {
        departingDate = picked;
        controllerdepartingOn.text = picked.toString(); // Update the TextField text
      });
  }

  Future<void> _selectReturningDate(BuildContext context) async {
    final DateTime? picked = await showDatePicker(
      context: context,
      initialDate: DateTime.now(),
      firstDate: DateTime(1900),
      lastDate: DateTime.now(),
    );
    if (picked != null && picked != returningDate)
      setState(() {
        returningDate = picked;
        controllerreturningOn.text = picked.toString(); // Update the TextField text
      });
  }

  Future<void> _selectSubmissionDate(BuildContext context) async {
    final DateTime? picked = await showDatePicker(
      context: context,
      initialDate: DateTime.now(),
      firstDate: DateTime(1900),
      lastDate: DateTime.now(),
    );
    if (picked != null) {
      setState(() {
        controllerdate.text = picked.toString(); // Update the TextField text
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('FILL THIS FORM BELOW'),
        centerTitle: true,
        backgroundColor: Colors.black54,
      ),
      body: SafeArea(
        child: Center(
          child: Card(
            margin: EdgeInsets.all(20),
            child: Padding(
              padding: EdgeInsets.all(20),
              child: Form(
                key: _formKey,
                child: ListView(
                  shrinkWrap: true,
                  children: <Widget>[
                    TextFormField(
                      controller: controllerfullName,
                      style: TextStyle(fontFamily: "Netflix", fontSize: 15),
                      decoration: InputDecoration(
                        hintText: "Enter Fullname",
                        labelText: "Fullname*",
                        hintStyle: TextStyle(fontFamily: "Netflix"),
                        labelStyle: TextStyle(fontFamily: "Netflix"),
                      ),
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Please enter your fullname';
                        }
                        return null;
                      },
                    ),
                    SizedBox(height: 10),
                    TextFormField(
                      controller: controllerregNo,
                      style: TextStyle(fontFamily: "Netflix", fontSize: 15),
                      decoration: InputDecoration(
                        hintText: "Enter RegNo",
                        labelText: "RegNo*",
                        hintStyle: TextStyle(fontFamily: "Netflix"),
                      ),
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Please enter your registration number';
                        }
                        return null;
                      },
                    ),
                    SizedBox(height: 10),
                    DropdownButtonFormField<String>(
                      value: selectedYearOfStudy,
                      onChanged: (String? newValue) {
                        setState(() {
                          selectedYearOfStudy = newValue;
                        });
                      },
                      items: yearOfStudyOptions
                          .map<DropdownMenuItem<String>>((String value) {
                        return DropdownMenuItem<String>(
                          value: value,
                          child: Text(
                            value,
                            style: TextStyle(fontFamily: "Netflix"),
                          ),
                        );
                      }).toList(),
                      decoration: InputDecoration(
                        hintText: "Select Year Of Study",
                        labelText: "YearOfStudy*",
                        hintStyle: TextStyle(fontFamily: "Netflix"),
                        labelStyle: TextStyle(fontFamily: "Netflix"),
                      ),
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Please select your year of study';
                        }
                        return null;
                      },
                    ),
                    SizedBox(height: 10),
                    TextFormField(
                      controller: controllerCourse,
                      style: TextStyle(fontFamily: "Netflix", fontSize: 15),
                      decoration: InputDecoration(
                        hintText: "Enter Course",
                        labelText: "Course*",
                        hintStyle: TextStyle(fontFamily: "Netflix"),
                        labelStyle: TextStyle(fontFamily: "Netflix"),
                      ),
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Please enter your course';
                        }
                        return null;
                      },
                    ),
                    SizedBox(height: 10),
                    DropdownButtonFormField<String>(
                      value: selectedDept,
                      onChanged: (String? newValue) {
                        setState(() {
                          selectedDept = newValue;
                        });
                      },
                      items: deptOptions
                          .map<DropdownMenuItem<String>>((String value) {
                        return DropdownMenuItem<String>(
                          value: value,
                          child: Text(
                            value,
                            style: TextStyle(fontFamily: "Netflix"),
                          ),
                        );
                      }).toList(),
                      decoration: InputDecoration(
                        hintText: "Select Department",
                        labelText: "Department*",
                        hintStyle: TextStyle(fontFamily: "Netflix"),
                        labelStyle: TextStyle(fontFamily: "Netflix"),
                      ),
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Please select your department';
                        }
                        return null;
                      },
                    ),
                    SizedBox(height: 10),
                    DropdownButtonFormField<String>(
                      value: selectedSchool,
                      onChanged: (String? newValue) {
                        setState(() {
                          selectedSchool = newValue;
                        });
                      },
                      items: schoolOptions
                          .map<DropdownMenuItem<String>>((String value) {
                        return DropdownMenuItem<String>(
                          value: value,
                          child: Text(
                            value,
                            style: TextStyle(fontFamily: "Netflix"),
                          ),
                        );
                      }).toList(),
                      decoration: InputDecoration(
                        hintText: "Enter School",
                        labelText: "School*",
                        hintStyle: TextStyle(fontFamily: "Netflix"),
                        labelStyle: TextStyle(fontFamily: "Netflix"),
                      ),
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Please select your school';
                        }
                        return null;
                      },
                    ),
                    SizedBox(height: 10),
                    TextFormField(
                      controller: controllerdays,
                      style: TextStyle(fontFamily: "Netflix", fontSize: 15),
                      decoration: InputDecoration(
                        hintText: "Enter total days",
                        labelText: "Total Days*",
                        hintStyle: TextStyle(fontFamily: "Netflix"),
                        labelStyle: TextStyle(fontFamily: "Netflix"),
                      ),
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Please enter total days';
                        }
                        return null;
                      },
                    ),
                    SizedBox(height: 10),
                    TextFormField(
                      controller: controllerdepartingOn,
                      readOnly: true,
                      onTap: () => _selectDepartingDate(context),
                      style: TextStyle(fontFamily: "Netflix", fontSize: 15),
                      decoration: InputDecoration(
                        hintText: "Enter Departing On",
                        labelText: "DepartingOn*",
                        hintStyle: TextStyle(fontFamily: "Netflix"),
                      ),
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Please select departing date';
                        }
                        return null;
                      },
                    ),
                    SizedBox(height: 10),
                    TextFormField(
                      controller: controllerreturningOn,
                      readOnly: true,
                      onTap: () => _selectReturningDate(context),
                      style: TextStyle(fontFamily: "Netflix", fontSize: 15),
                      decoration: InputDecoration(
                        hintText: "Enter returning On",
                        labelText: "ReturningOn*",
                        hintStyle: TextStyle(fontFamily: "Netflix"),
                        labelStyle: TextStyle(fontFamily: "Netflix"),
                      ),
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Please select returning date';
                        }
                        return null;
                      },
                    ),
                    SizedBox(height: 10),
                    TextFormField(
                      controller: controllerreasonFor,
                      maxLines: null,
                      style: TextStyle(fontFamily: "Netflix", fontSize: 15),
                      decoration: InputDecoration(
                        hintText: "Enter reason for permission",
                        labelText: "ReasonFor*",
                        hintStyle: TextStyle(fontFamily: "Netflix"),
                      ),
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Please enter reason for permission';
                        }
                        return null;
                      },
                    ),
                    SizedBox(height: 10),
                    TextFormField(
                      controller: controllerphoneNumber,
                      style: TextStyle(fontFamily: "Netflix", fontSize: 15),
                      decoration: InputDecoration(
                        hintText: "Enter phone number",
                        labelText: "PhoneNumber*",
                        hintStyle: TextStyle(fontFamily: "Netflix"),
                        labelStyle: TextStyle(fontFamily: "Netflix"),
                      ),
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Please enter your phone number';
                        }
                        return null;
                      },
                    ),
                    SizedBox(height: 10),
                    TextFormField(
                      controller: controllerdate,
                      readOnly: true,
                      onTap: () => _selectSubmissionDate(context),
                      style: TextStyle(fontFamily: "Netflix", fontSize: 15),
                      decoration: InputDecoration(
                        hintText: "Enter issued date",
                        labelText: "Submission Date*",
                        hintStyle: TextStyle(fontFamily: "Netflix"),
                      ),
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Please select submission date';
                        }
                        return null;
                      },
                    ),
                    SizedBox(height: 10),
                    ElevatedButton(
                      onPressed: () {
                        sentRequest();
                      },
                      child: Text(
                        "Send request",
                        style: TextStyle(color: Colors.white),
                      ),
                      style: ElevatedButton.styleFrom(
                        backgroundColor: Colors.black54,
                      ),
                    ),
                    if (_loading) // Circular loading indicator
                      Center(
                        child: CircularProgressIndicator(),
                      ),
                  ],
                ),
              ),
            ),
          ),
        ),
      ),
      drawer: Drawer(
        child: ListView(
          padding: const EdgeInsets.all(0),
          children: [
            const DrawerHeader(
              decoration: BoxDecoration(
                color: Colors.black54,
              ),
              child: Text(
                'STUDENT OPTIONS',
                style: TextStyle(fontWeight: FontWeight.bold, fontSize: 25.0, color: Colors.white),
              ),
            ),
            ListTile(
              leading: const Icon(Icons.person),
              title: const Text('Password reset'),
              onTap: () {
                Navigator.pushReplacement(
                  context,
                  MaterialPageRoute(builder: (context) => PasswordReset()),
                );
              },
            ),
            ListTile(
              leading: const Icon(Icons.logout),
              title: const Text('LogOut'),
              onTap: () {
                Navigator.pushReplacement(context, MaterialPageRoute(builder: (context) {
                  return PLogin();
                }));
              },
            ),
          ],
        ),
      ),
    );
  }
}

