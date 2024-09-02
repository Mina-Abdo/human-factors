document.addEventListener("DOMContentLoaded", function() {
    const userIcon = document.getElementById("user-icon");
    const dropdown = document.getElementById("dropdown");

    // Toggle dropdown on click
    userIcon.addEventListener("click", function(event) {
        event.preventDefault(); // Prevent the default action
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    });

    // Close the dropdown if the user clicks outside of it
    document.addEventListener("click", function(event) {
        if (!userIcon.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.style.display = "none";
        }
    });
});
const medicationDose = document.getElementById('medicationDose');
const medicationDailyLog = document.getElementById('medicineDailyLog');
const medicationWeeklyLog = document.getElementById('medicineWeeklyLog');
const sleepHrs = document.getElementById('sleepHrs');
const sleepLogs = document.getElementById('sleepLogs');
excerciseLogs = document.getElementsByClassName('excerciseLogs')
if(medicationDailyLog.textContent < medicationDose.textContent){
    medicationDailyLog.style.color = 'red';
    medicationDailyLog.style.fontWeight = 'bold'
}
if(medicationWeeklyLog.textContent < 7){
    medicationWeeklyLog.style.color = 'red';
    medicationWeeklyLog.style.fontWeight = 'bold';
}else if(medicationWeeklyLog.textContent == 7){
    medicationWeeklyLog.style.color = 'green';
    medicationWeeklyLog.style.fontWeight = 'bold';
}
if(sleepHrs.textContent < 6){
    sleepHrs.style.color = 'red';
    sleepHrs.style.fontWeight = 'bold'
}else if(sleepHrs.textContent >= 6 && sleepHrs.textContent<= 8){
    sleepHrs.style.color = 'green';
    sleepHrs.style.fontWeight = 'bold'
}
if(sleepLogs.textContent < 7){
    sleepLogs.style.color = 'red';
    sleepLogs.style.fontWeight = 'bold';
}
for(let i = 0; i<excerciseLogs.length; i ++){
    if(excerciseLogs[i].textContent < 7){
        excerciseLogs[i].style.color = 'red';
        excerciseLogs[i].style.fontWeight = 'bold';
    }else if(excerciseLogs[i].textContent == 7){
        excerciseLogs[i].style.color = 'green';
        excerciseLogs[i].style.fontWeight = 'bold';
    }
}