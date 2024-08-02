import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:fluttertoast/fluttertoast.dart'; // Import Fluttertoast package

void main() => runApp(MaterialApp(
  debugShowCheckedModeBanner: false,
  home: Status(),
));

class Status extends StatefulWidget {
  const Status({Key? key}) : super(key: key);

  @override
  _StatusState createState() => _StatusState();
}

class _StatusState extends State<Status> {
  List<Map<String, dynamic>> data = [];
  List<Map<String, dynamic>> filteredData = [];
  bool isLoading = true;
  TextEditingController searchController = TextEditingController();

  @override
  void initState() {
    super.initState();
    fetchData();
  }

  Future<void> fetchData() async {
    final response = await http.get(
      Uri.parse("http://127.0.0.1/kazi1R/studentapp/apis/status.php"),
    );

    if (response.statusCode == 200) {
      setState(() {
        isLoading = false;
        data = List<Map<String, dynamic>>.from(json.decode(response.body));
        filteredData = data; // Initialize filteredData with all data
      });
    } else {
      throw Exception('Failed to load data');
    }
  }

  void filterData(String searchTerm) {
    setState(() {
      filteredData = data
          .where((item) =>
          item['fullName']
              .toString()
              .toLowerCase()
              .contains(searchTerm.toLowerCase()))
          .toList();
    });

    // Check if filtered data is empty
    if (filteredData.isEmpty) {
      // Show toast message if no results found
      Fluttertoast.showToast(
        msg: "You are not granted permission. Please wait.",
        backgroundColor: Colors.red,
        textColor: Colors.white,
        toastLength: Toast.LENGTH_LONG,
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.black54,
        title: Text(
          "YOUR PERMISSION STATUS",
          style: TextStyle(fontFamily: "Netflix"),
        ),
      ),
      body: Center(
        child: Column(
          children: [
            Padding(
              padding: const EdgeInsets.all(8.0),
              child: Container(
                width: MediaQuery.of(context).size.width * 0.7,
                child: TextField(
                  controller: searchController,
                  onChanged: (value) {
                    filterData(value);
                  },
                  decoration: InputDecoration(
                    hintText: 'Search by Full Name',
                    border: OutlineInputBorder(),
                    suffixIcon: IconButton(
                      onPressed: () {
                        searchController.clear();
                        filterData('');
                      },
                      icon: Icon(Icons.clear),
                    ),
                  ),
                ),
              ),
            ),
            isLoading
                ? CircularProgressIndicator()
                : Expanded(
              child: ListView.builder(
                itemCount: filteredData.length,
                itemBuilder: (context, index) {
                  return Card(
                    elevation: 3,
                    shadowColor: Colors.grey,
                    margin: EdgeInsets.symmetric(
                        vertical: 10, horizontal: 20),
                    child: Padding(
                      padding: EdgeInsets.all(20),
                      child: Row(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                'Full Name:',
                                style: TextStyle(
                                    fontWeight: FontWeight.bold),
                              ),
                              SizedBox(height: 5),
                              Text('Registration No:'),
                              SizedBox(height: 5),
                              Text('Year of Study:'),
                              SizedBox(height: 5),
                              Text('Course:'),
                              SizedBox(height: 5),
                              Text('School:'),
                              SizedBox(height: 5),
                              Text('Approval Status:'),
                              Text('Approved at'),
                            ],
                          ),
                          SizedBox(width: 20),
                          Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                '${filteredData[index]['fullName']}',
                                style: TextStyle(
                                    fontWeight: FontWeight.bold),
                              ),
                              SizedBox(height: 5),
                              Text('${filteredData[index]['regNo']}'),
                              SizedBox(height: 5),
                              Text('${filteredData[index]['yearOfStudy']}'),
                              SizedBox(height: 5),
                              Text('${filteredData[index]['Course']}'),
                              SizedBox(height: 5),
                              Text('${filteredData[index]['School']}'),
                              SizedBox(height: 5),
                              Text('${filteredData[index]['approveForDeanOfSchl']}'),
                              Text('${filteredData[index]['approved3_at']}'),
                              SizedBox(height: 5),
                              // Icon to represent permission status
                              Icon(
                                Icons.check_circle,
                                color: Colors.green, // Green color for granted permission
                              ),
                            ],
                          ),
                        ],
                      ),
                    ),
                  );
                },
              ),
            ),
          ],
        ),
      ),
    );
  }
}
