// Patient data for each therapist
const tPatients = {
  "John David": [
    { id: "P0001", type:"Anxiety Disorders", consultLength: "10h" },
    { id: "P0002", type:"Anxiety Disorders", consultLength: "1h30m" },
    { id: "P0003", type:"Anxiety Disorders", consultLength: "15h" },
    { id: "P0004", type:"Anxiety Disorders", consultLength: "20h" }
  ],
  "Melissa Anderson": [
    { id: "P0008", type:"Eating Disorders", consultLength: "11h" },
    { id: "P0012", type:"Eating Disorders", consultLength: "10h5m" },
    { id: "P0013", type:"Eating Disorders", consultLength: "3h" }
  ],
  "Simon Joel": [
    { id: "P0009", type:"Eating Disorders", consultLength: "10h" },
    { id: "P0015", type:"Eating Disorders", consultLength: "6h" }
  ],
  "Michael Smith": [
    { id: "P0021", type:"Mood Disorders", consultLength: "8h" },
    { id: "P0031", type:"Mood Disorders", consultLength: "18h" },
    { id: "P0041", type:"Mood Disorders", consultLength: "13h" }
  ],
  "Sam Dsouza": [
    { id: "P0016", type:"Eating Disorders", consultLength: "20h" },
    { id: "P0017", type:"Eating Disorders", consultLength: "30h" },
    { id: "P0019", type:"Eating Disorders", consultLength: "10h" }
  ],
  "Anna George": [
    { id: "P0023", type:"Mood Disorders", consultLength: "30h" },
    { id: "P0025", type:"Mood Disorders", consultLength: "10h" }
  ]
};

// Function to display patient details
function showPatientDetails(therapist) {
  // Show therapist name and general information
  const therapistNameElement = document.getElementById('therapist-name');
  therapistNameElement.textContent = therapist;

  const therapistInfoElement = document.getElementById('therapist-info');
  therapistInfoElement.textContent = "therapist basic information";
  //
  const patients = tPatients[therapist];

  // Display number of patients
  const patientCountElement = document.getElementById('patient-count');
  patientCountElement.textContent = `Number of Patients: ${patients.length}`;

  // Create a table of patient names
  let tableHTML = `<table class="default">
                      <tr>
                          <th>Patient ID</th>
                          <th>Patient Type</th>
                          <th>Consultation Time</th>
                      </tr>`;

  patients.forEach(patient => {
    tableHTML += `<tr>
      <td>${patient.id}</td>
      <td>${patient.type}</td>
      <td>${patient.consultLength}</td>
      </tr>`;
  });

  tableHTML += `</table>`;

  // Display the table
  const patientDetailsElement = document.getElementById('patient-details');
  patientDetailsElement.innerHTML = tableHTML;
}

// Add event listeners to therapist names
document.querySelectorAll('.therapist-list li').forEach(item => {
  item.addEventListener('click', function () {
    const therapist = this.getAttribute('therapist');
    showPatientDetails(therapist);
  });
});
