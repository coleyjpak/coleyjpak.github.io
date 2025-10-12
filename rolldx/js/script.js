var result;
var genMax;
var genMin;
var resultLog = "";

const LISTELEMENT = document.querySelector("#resultLogDisplay");

function genRandomNumber() {
  console.log("Command running...");

  genMax = parseInt(document.getElementById("genMaxInput").value);
  genMin = parseInt(document.getElementById("genMinInput").value);

  if (genMax > genMin && Number.isInteger(genMax) && Number.isInteger(genMin)) {

    result = Math.floor(Math.random() * Math.floor(genMax - genMin + 1)) + genMin;
    document.querySelector("#numberDisplay").innerHTML = "<b>" + result + "</b>";

    document.querySelector("#numberDisplay").classList.remove("roll-max");
    document.querySelector("#numberDisplay").classList.remove("roll-min");

    document.querySelector("#errorDisplay").classList.remove("bg-danger");
    document.querySelector("#errorDisplay").innerHTML = "";



    if (result==genMax) {
      document.querySelector("#numberDisplay").classList.add("roll-max");
      resultLog = "<tr><td class='roll-max-table'><i>" + result + "</i></td><td>" + genMin + " to " + genMax + "</td></tr>" + resultLog;
    } else if (result==genMin) {
      document.querySelector("#numberDisplay").classList.add("roll-min");
      resultLog = "<tr><td class='roll-min-table'><i>" + result + "</i></td><td>" + genMin + " to " + genMax + "</td></tr>" + resultLog;
    } else {
      resultLog = "<tr><td class>" + result + "</td><td>" + genMin + " to " + genMax + "</td></tr>" + resultLog;
    }

    // var listElement = document.createElement("tr");
    // var listText = document.createElement("td");
    // var listText = document.createTextNode(
    //   "<td>" + result + "</td>" + "<td>" + genMin + "</td>" + "<td>-</td><td>" +  genMax + "</td>"
    // );
    // listElement.prepend(listText);

    LISTELEMENT.innerHTML = resultLog;

  } else {
    document.querySelector("#errorDisplay").classList.add("bg-danger");
     if (genMax <= genMin) {
      document.querySelector("#errorDisplay").innerHTML = "ERROR: Minimum is larger than/same as maximum";
    } else if (!Number.isInteger(genMax) || !Number.isInteger(genMin)) {
      document.querySelector("#errorDisplay").innerHTML = "ERROR: Non-integer inputs";
    } else {
      document.querySelector("#errorDisplay").innerHTML = "ERROR: Unknown error";
    }
  }
}

// function genRandomNumber() {
//   console.log("genRandomNumber running...")
//   var result;
//   result = Math.random(100);
//   document.querySelector("#numberDisplay").innerHTML = result;
// }

function resetLog() {
  resultLog = "";
  LISTELEMENT.innerHTML = "<tr><td>---</td><td>---</td></tr>";
  document.querySelector("#numberDisplay").innerHTML = "...";
  document.querySelector("#numberDisplay").classList.remove("roll-max");
  document.querySelector("#numberDisplay").classList.remove("roll-min");
  document.querySelector("#numberDisplay").style.backgroundColor = null;
}

function onloadFunction() {
  document.getElementById("genMaxInput").value = 20;
  document.getElementById("genMinInput").value = 1;
  LISTELEMENT.innerHTML = "<tr><td>---</td><td>---</td></tr>";
}

// jQ example: $('#genMaxInput')=20;
