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
}else{
    sleepLogs.style.color = 'green';
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
document.addEventListener('DOMContentLoaded', function() {
    // Check if the URL contains 'edit_medicine=success'
    let urlParams = new URLSearchParams(window.location.search);
    const successMessage = document.getElementById('success-message');
        successMessage.style.display = 'block';  // Show the message
        successMessage.style.backgroundColor = "#c8f3a8";
        successMessage.style.marginLeft = "3%";
        successMessage.style.marginRight = "3%";
        successMessage.style.textAlign = 'center';
    if (urlParams.get('edit_medicine') === 'success') {
        successMessage.innerHTML = "Medicine edited successfully";
    }
    if(urlParams.get('notes_upload' ) === 'success'){
        successMessage.innerHTML = "Notes uploaded successfully";
        
    }
    if(urlParams.get('add_medicine') === 'success'){
        successMessage.innerHTML = "Medicine added successfully";
    }
    if(urlParams.get('medicine_deleted') === 'success'){
        successMessage.innerHTML = 'Medicine deleted successfully';
    }
    setTimeout(function() {
        successMessage.style.display = 'none';
    }, 2100);
});