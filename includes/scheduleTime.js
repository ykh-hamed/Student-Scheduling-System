 var faculty;
 var year;
 var module;

 function start() {
     faculty = document.getElementById("facultySelect");
     faculty.addEventListener("change", loadYears);
 }

 function loadYears() {
     //Get Years from database 

     year = document.getElementById("yearSelect");
     year.addEventListener("change", loadModules)
 }

 function loadModules() {
     //Get modules from database
     var selectedFaculty = faculty.options[faculty.selectedIndex].value;


     //Display modules
     var modulesDiv = document.getElementById("modulesDiv");
     modulesDiv.innerHTML = ' <label>Module:</label><select id="moduleSelect" > <option disabled selected value > -- select an option -- </option> <option value="Module1">Module1</option>   <option value="Module2">Module2</option><option value="Module3">Module3</option><option value="Module4">Module4</option></select>';

     module = document.getElementById("moduleSelect");
     module.addEventListener("change", loadTimeSlots)
 }

 function loadTimeSlots() {
     var selectedModule = module.options[module.selectedIndex].value;
     var timeSlots = document.getElementById("TimeSlotsDiv");
     timeSlots.innerHTML = "<label>TimeSlots:</label><br><br><input type=\"checkbox\" name=\"1\" value=\"1\"> 09:00    -  10:00<br><input type=\"checkbox\" name=\"2\" value=\"2\"> 10:00   -    11:00<br><input type=\"checkbox\" name=\"3\" value=\"3\"> 11:00   -   12:00<br><input type=\"checkbox\" name=\"4\" value=\"4\"> 12:00   -   13:00<br><input type=\"checkbox\" name=\"5\" value=\"5\"> 13:00    -   14:00 <br><input type=\"checkbox\" name=\"6\" value=\"6\"> 14:00     -   15:00<br><input type=\"checkbox\" name=\"7\" value=\"7\"> 15:00  -  16:00<br>";

     document.getElementById("submitBtn").innerHTML = '<input type="submit" value="submitChanges">';
 }
 window.addEventListener("load", start);