import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:fluttertoast/fluttertoast.dart';
import 'dart:convert';

import 'login.dart'; // Import PLogin widget

class AddData extends StatefulWidget {
  @override
  _AddDataState createState() => _AddDataState();
}

class _AddDataState extends State<AddData> {
  TextEditingController controllerName = TextEditingController();
  TextEditingController controllerEmail = TextEditingController();
  TextEditingController controllerPassword = TextEditingController();
  bool _isLoading = false;

  void showToast(String message) {
    Fluttertoast.showToast(
      msg: message,
      toastLength: Toast.LENGTH_SHORT,
      gravity: ToastGravity.BOTTOM,
      timeInSecForIosWeb: 1,
      backgroundColor: Colors.green,
      textColor: Colors.white,
      fontSize: 16.0,
    );
  }

  void _toggleLoading() {
    setState(() {
      _isLoading = !_isLoading;
    });
  }

  Future<void> addData() async {
    _toggleLoading();

    var url = Uri(
      scheme: "http",
      host: "127.0.0.1",
      port: 80,
      path: "/kazi1R/studentapp/apis/registration.php",
    );

    try {
      final response = await http.post(url, body: {
        "fullName": controllerName.text,
        "email": controllerEmail.text,
        "password": controllerPassword.text,
      });

      if (response.statusCode == 200) {
        final responseData = json.decode(response.body);
        if (responseData['message'] == 'Student registered successfully') {
          showToast("Registration successful!"); // Show toast for successful registration
          Navigator.pop(context); // Navigate back to previous screen
        } else if (responseData['message'] == 'Email already taken') {
          showToast("Email already exists"); // Show toast for existing email
        } else {
          showToast("Error registering student");
        }
      } else {
        showToast("Error registering student");
      }
    } catch (e) {
      print("Exception: $e");
      showToast("An error occurred");
    } finally {
      _toggleLoading();
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          "Student Registration",
          style: TextStyle(fontFamily: "Netflix"),
        ),
        backgroundColor: Colors.black54,
      ),
      body: Container(
        decoration: BoxDecoration(
          image: DecorationImage(
            image: AssetImage("images/logo.png"),
            fit: BoxFit.cover,
          ),
        ),
        child: Padding(
          padding: const EdgeInsets.all(20.0),
          child: _isLoading
              ? Center(child: CircularProgressIndicator())
              : ListView(
            children: <Widget>[
              TextField(
                controller: controllerName,
                style: TextStyle(fontFamily: "Netflix", fontSize: 15, color: Colors.blue), // Set text color to blue
                decoration: InputDecoration(
                  hintText: "Enter fullname",
                  hintStyle: TextStyle(fontFamily: "Netflix", color: Colors.blue), // Set hint text color to blue
                  labelText: "Fullname",
                  labelStyle: TextStyle(fontFamily: "Netflix", color: Colors.blue), // Set label text color to blue
                ),
              ),
              TextField(
                controller: controllerEmail,
                style: TextStyle(fontFamily: "Netflix", fontSize: 15, color: Colors.blue), // Set text color to blue
                decoration: InputDecoration(
                  hintText: "Enter email",
                  hintStyle: TextStyle(fontFamily: "Netflix", color: Colors.blue), // Set hint text color to blue
                  labelText: "Email",
                  labelStyle: TextStyle(fontFamily: "Netflix", color: Colors.blue), // Set label text color to blue
                ),
              ),
              TextField(
                controller: controllerPassword,
                style: TextStyle(fontFamily: "Netflix", fontSize: 15, color: Colors.blue), // Set text color to blue
                decoration: InputDecoration(
                  hintText: "Enter your password",
                  hintStyle: TextStyle(fontFamily: "Netflix", color: Colors.blue), // Set hint text color to blue
                  labelText: "Password",
                  labelStyle: TextStyle(fontFamily: "Netflix", color: Colors.blue), // Set label text color to blue
                ),
              ),
              Padding(
                padding: const EdgeInsets.all(10.0),
              ),
              Container(
                height: 50,
                width: double.infinity,
                child: ElevatedButton(
                  onPressed: () {
                    if (controllerName.text.isEmpty) {
                      showToast("Name needed");
                    } else if (controllerEmail.text.isEmpty) {
                      showToast("Email needed");
                    } else if (controllerPassword.text.isEmpty) {
                      showToast("Password needed");
                    } else {
                      addData();
                    }
                  },
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.black54, // Change button color to black
                  ),
                  child: Text(
                    "Register",
                    style: TextStyle(color: Colors.white),
                  ),
                ),
              )
            ],
          ),
        ),
      ),
    );
  }
}
