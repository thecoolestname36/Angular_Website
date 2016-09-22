// Object Definition
// This should be declared in a seperate file
function MyObject(name) {

	// You can declare object variables here
	this.number = 1;
	this.objMethod = "My Method";

	// Constructor gets called on object creation
	(function constructor(obj) {
		obj.instanceName = name;
		console.log("Created : " + obj.instanceName);
	})(this);
	
	// Object definitions
	this.printName = function() {
		
		console.log(this.instanceName + " : " + this.objMethod);
	};

	this.setName = function(str) {
		this.instanceName = str;
	};

	this.printNumber = function() {
		console.log("Number : " + this.number);
	}
};


//  Declare and use objects in a main function or seperate file

var myObject = new MyObject("My Object");
var otherObject = new MyObject("Other Object");

myObject.setName("Changed");
myObject.printName();

otherObject.printName();