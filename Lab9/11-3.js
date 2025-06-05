var grades = [];

function calculateAverage(physics, calculus, discreteMath) {
    return ((physics || 0) + (calculus || 0) + (discreteMath || 0)) / 3;
}

function loadGrades() {
    var gradeTableBody = document.getElementById("gradeTableBody");
    gradeTableBody.innerHTML = "";

    for (var i = 0; i < localStorage.length; i++) {
        var studentId = localStorage.key(i);
        var gradeData = JSON.parse(localStorage.getItem(studentId));
        
        if (gradeData) {
            var average = calculateAverage(gradeData.physics, gradeData.calculus, gradeData.discreteMath);
            var row = gradeTableBody.insertRow();
            
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            
            cell1.textContent = studentId;
            cell2.textContent = gradeData.physics;
            cell3.textContent = gradeData.calculus;
            cell4.textContent = gradeData.discreteMath;
            cell5.textContent = average.toFixed(2);
            cell6.innerHTML = "<button onclick='localStorage.removeItem(\"" + studentId + "\"); loadGrades();'>Delete</button>";
            // cell6.innerHTML = "<button onclick='deleteGrade(\"" + studentId + "\")'>Delete</button>";
        }
    }
}

function saveGrade() {
    var studentId = document.getElementById("studentId").value;
    var physics = parseInt(document.getElementById("physics").value);
    var calculus = parseInt(document.getElementById("calculus").value);
    var discreteMath = parseInt(document.getElementById("discreteMath").value);

    if (!studentId) {
        alert("請輸入學生編號");
        return;
    }

    var gradeData = {
        physics: physics,
        calculus: calculus,
        discreteMath: discreteMath
    };

    localStorage.setItem(studentId, JSON.stringify(gradeData));
    loadGrades();
    clearInputFields();
}

// function deleteGrade(studentId) {
//     if (confirm("確定要刪除 " + studentId + " 的成績嗎？")) {
//         localStorage.removeItem(studentId);
//         loadGrades();
//     }
// }

function clearInputFields() {
    document.getElementById("studentId").value = "";
    document.getElementById("physics").value = "";
    document.getElementById("calculus").value = "";
    document.getElementById("discreteMath").value = "";
}

window.onload = function() {
    // localStorage.clear();
    loadGrades();
};