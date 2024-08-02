import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:fluttertoast/fluttertoast.dart';
import 'dart:convert';

import 'pdashboard.dart'; // Import PDashboard widget
import 'register.dart'; // Import AddData widget

void main() => runApp(MaterialApp(
  debugShowCheckedModeBanner: false,
  home: PLogin(),
));

class PLogin extends StatefulWidget {
  const PLogin({Key? key}) : super(key: key);

  @override
  _PLoginPageState createState() => _PLoginPageState();
}

class _PLoginPageState extends State<PLogin> {
  TextEditingController emailController = TextEditingController();
  TextEditingController passwordController = TextEditingController();
  bool _isLoading = false;

  void showToast(String message) {
    Fluttertoast.showToast(
      msg: message,
      backgroundColor: Colors.green,
      textColor: Colors.white,
      toastLength: Toast.LENGTH_SHORT,
    );
  }

  Future<void> login() async {
    if (!validateForm()) return;

    setState(() {
      _isLoading = true; // Start loading indicator
    });

    var url = Uri(
      scheme: "http",
      host: "localhost",
      port: 80,
      path: "kazi1R/studentapp/apis/login.php",
    );

    try {
      final response = await http.post(url, body: {
        "email": emailController.text,
        "password": passwordController.text,
      });

      var data = json.decode(response.body); // Parse JSON response

      if (data == "Success") {
        showToast('Login Successful');
        // Navigate to dashboard after successful login
        Navigator.push(
          context,
          MaterialPageRoute(builder: (context) => PDashboard()),
        );
      } else {
        showToast('Username and password invalid');
      }
    } catch (e) {
      print("Exception: $e");
      showToast('An error occurred');
    } finally {
      setState(() {
        _isLoading = false; // Stop loading indicator
      });
    }
  }

  // Form validation method
  bool validateForm() {
    if (emailController.text.isEmpty || passwordController.text.isEmpty) {
      showToast('Please fill all fields');
      return false;
    }
    return true;
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Student login'),
        backgroundColor: Colors.black54,
      ),
      body: Stack(
        children: [
          // Background image
          Positioned.fill(
            child: Image.asset(
              'images/logo.png',
              fit: BoxFit.cover,
            ),
          ),
          // Main content
          Padding(
            padding: const EdgeInsets.all(20.0),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.stretch,
              mainAxisAlignment: MainAxisAlignment.center,
              children: <Widget>[
                Text(
                  'Login',
                  style: TextStyle(
                    fontWeight: FontWeight.bold,
                    fontSize: 25.0,
                    color: Colors.white,
                  ),
                  textAlign: TextAlign.center,
                ),
                SizedBox(height: 10.0),
                TextField(
                  controller: emailController,
                  decoration: InputDecoration(
                    hintText: 'Email',
                    filled: true,
                    fillColor: Colors.white.withOpacity(0.8),
                  ),
                ),
                SizedBox(height: 16),
                TextField(
                  obscureText: true,
                  controller: passwordController,
                  decoration: InputDecoration(
                    hintText: 'Password',
                    filled: true,
                    fillColor: Colors.white.withOpacity(0.8),
                  ),
                ),
                SizedBox(height: 24),
                _isLoading
                    ? Center(child: CircularProgressIndicator())
                    : ElevatedButton(
                  onPressed: login,
                  child: Text(
                    "LOGIN",
                    style: TextStyle(
                      fontSize: 24,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.black54,
                    padding: EdgeInsets.symmetric(vertical: 12),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(25),
                    ),
                  ),
                ),
                SizedBox(height: 20.0),
                TextButton(
                  onPressed: () {
                    Navigator.pushReplacement(context,
                        MaterialPageRoute(builder: (context) {
                          return AddData();
                        }));
                  },
                  child: Text(
                    'Don\'t have an account? Sign up here',
                    style: TextStyle(
                      fontSize: 16.0,
                      color: Colors.white,
                    ),
                  ),
                )
              ],
            ),
          ),
        ],
      ),
    );
  }
}
