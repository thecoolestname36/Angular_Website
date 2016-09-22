//* // Angular dependency // *//

// Constant vars object
function SemesterInitVars() {
	this.textD = document.getElementById("totalDays").innerHTML;
	this.textDr = document.getElementById("semesterDaysRem").innerHTML;
	this.textPr = document.getElementById("semesterPercentRem").innerHTML;
	this.school = new Object();
	this.school.start = new Date(
		2015,
		(08-1),
		31
	);
	this.school.end = new Date(
		2015,
		(12 -1),
		18
	);
	this.army = new Object();
	this.army.start = new Date(
		2016,
		(1-1),
		12
	);
	this.army.end = new Date(
		2016,
		(7-1),
		5
	);
};


// Functions object
function SemesterCountdown(initVars) {

	// Class Variables
	this.vars = initVars;

	(function constructor(self){
		
	})(this);

	this.getSemesterCountdown = function() {

		var start = new Date(document.getElementsByName('startYear')[0].value,
			(document.getElementsByName('startMonth')[0].value -1),
			document.getElementsByName('startDate')[0].value);
		var end = new Date(document.getElementsByName('endYear')[0].value,
			(document.getElementsByName('endMonth')[0].value -1),
			document.getElementsByName('endDate')[0].value);
		var today = new Date();
		
		this.calculate(start, end, today);
	};

	this.changeDates = function(elem) {

		var view = document.getElementsByName(elem.name);

		for(var i=0; i<view.length; i++) 
		{
			var item = view[i];

			if(!(item === null || item ===undefined) && view[i].checked) {
				if(view[i].value == "semester") {
					console.log("Yup");	
					//this.calculate();
					//this.setHTML();
				} else if (view[i].value == "army") {
					console.log("Nope");
				}
			}
		}
	};

	this.setHTML = function(start, end, today) {

	}

	this.calculate = function(start, end, today) {
		// 86400000 milliseconds to one day
		var msToDay = 86400000;
		var totalDays = (end.getTime() - start.getTime())/msToDay;
		var daysRem = (end.getTime() - (new Date()).getTime())/msToDay;

		document.getElementById("totalDays").innerHTML = this.vars.textD + totalDays.toFixed(0) + " days ( " + 
																(totalDays/7).toFixed(1) + "w or " + 
																(totalDays/30).toFixed(1) + "mo )";
		document.getElementById("semesterDaysRem").innerHTML = this.vars.textDr + daysRem.toFixed(0) + " days ( " + 
																(daysRem/7).toFixed(1) + "w or " + 
																(daysRem/30).toFixed(1) + "mo )";
		document.getElementById("semesterPercentRem").innerHTML = this.vars.textPr + parseInt((((new Date()).getTime() - start.getTime()) / ((end.getTime() - start.getTime()))*100), 10) + "%";
	}
};

// Angular dependency
angular.element(document).ready(function () {
    console.log("Angular Ready!:" + new Date());
    document.semCountdown = new SemesterCountdown(new SemesterInitVars());
    document.semCountdown.getSemesterCountdown();
});

//SemesterCountdown.initApplication(new SemesterInitVars());