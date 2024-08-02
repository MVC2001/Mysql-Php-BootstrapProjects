import 'package:doctorapointapp/components/login.dart';
import 'package:flutter/material.dart';

// Function to trigger app build
void main() => runApp(MaterialApp(
    debugShowCheckedModeBanner: false,
    home: MyApp()));

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('STUDENTS PERMISSION APPLICATION'),
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
          Column(
            children: [
              const SizedBox(height: 70.0),
              const SizedBox(height: 9.0),
              Padding(
                padding: const EdgeInsets.all(16.0),
                child: Column(
                  mainAxisSize: MainAxisSize.min,
                  children: const <Widget>[
                    Text(
                      'App info.com',
                      style: TextStyle(
                        fontSize: 24,
                        fontWeight: FontWeight.bold,
                        color: Colors.white,
                      ),
                    ),
                    SizedBox(height: 8),
                    Text(
                      'Students permission application. this app allow students with account search and view if permission  graanted or not.',
                      style: TextStyle(
                        fontSize: 16,
                        color: Colors.white,
                      ),
                      textAlign: TextAlign.center,
                    ),
                  ],
                ),
              ),
            ],
          ),
        ],
      ),
      drawer: Drawer(
        child: ListView(
          padding: EdgeInsets.zero,
          children: [
            const DrawerHeader(
              decoration: BoxDecoration(
                color: Colors.black54,
              ),
              child: UserAccountsDrawerHeader(
                decoration: BoxDecoration(color: Colors.black54),
                accountName: Text(
                  "STUDENT LOGIN PANEL",
                  style: TextStyle(fontSize: 18),
                ),
                accountEmail: Text(""),
                currentAccountPictureSize: Size.square(50),
              ),
            ),
            ListTile(
              leading: const Icon(Icons.person),
              title: const Text('Login'),
              onTap: () {
                Navigator.of(context).push(
                  MaterialPageRoute(builder: (BuildContext context) => PLogin()),
                );
              },
            ),
            ListTile(
              leading: const Icon(Icons.list),
              title: const Text('App info'),
              onTap: () {
                // Add your onTap code here!
              },
            ),
          ],
        ),
      ),
    );
  }
}
