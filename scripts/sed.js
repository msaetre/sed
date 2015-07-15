/* sed.js
 * 2014-08-16
 * http://sed.guru
 */
function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function escapeHtml(unsafe) {
  return $('<div />').text(unsafe).html();
}

function unescapeHtml(safe) {
  return $('<div />').html(safe).text();
}

function fileUploaded(newFile) {

  require(["ace/ace"], function run(ace) {

    var inputText = ace.edit("inputText");
    var read = new FileReader();
    read.readAsBinaryString(newFile);
    read.onloadend = function() {
      inputText.setValue(read.result);
    }

  });
}

function exportToFile() {
  var exportText = document.getElementById('outputText').innerText;
  if(typeof exportText == 'undefined') {
    exportText = document.getElementById('outputText').textContent;
  }
  var blob;
  var time = new Date().getTime();
  try {
    blob = new Blob(exportText.split(''), {type: "text/plain"});
  } 
  catch(e) {
    var BlobBuilder = window.WebKitBlobBuilder || window.MozBlobBuilder;
    var bb = new BlobBuilder();
    bb.append(exportText);
    blob = bb.getBlob("text/plain");
  }
  saveAs(blob, "sed_" + time + ".txt");
}

function inputTextContainerMouseOver() {
  if(document.getElementById('inputTextContainerOuter').style.width != '75%') {
    document.getElementById('inputExpandButton').style.display = 'block';
  } else {
    document.getElementById('inputExpandButton').style.display = 'none';
  }
}

function inputTextContainerMouseOut() {
  document.getElementById('inputExpandButton').style.display = 'none';
}

function outputTextContainerMouseOver() {
  if(document.getElementById('outputTextContainerOuter').style.width != '75%') {
    document.getElementById('outputExpandButton').style.display = 'block';
  } else {
    document.getElementById('outputExpandButton').style.display = 'none';
  }
}

function outputTextContainerMouseOut() {
  document.getElementById('outputExpandButton').style.display = 'none';
}

function inputExpandClicked() {
  var inputTextContainerWidth = document.getElementById('inputTextContainerOuter').style.width;
  if(inputTextContainerWidth == "25%") {
    document.getElementById('sed').style.width='50%';
    document.getElementById('outputPanel').style.width='50%';
    document.getElementById('inputTextContainerOuter').style.width='50%';
    document.getElementById('outputTextContainerOuter').style.width='50%'; 
  } else if ((inputTextContainerWidth == "50%") || (inputTextContainerWidth == '')) {
    document.getElementById('sed').style.width='75%';
    document.getElementById('outputPanel').style.width='25%';
    document.getElementById('inputTextContainerOuter').style.width='75%';
    document.getElementById('outputTextContainerOuter').style.width='25%';     
  }
  inputTextContainerMouseOver();
}

function outputExpandClicked() {
  var outputTextContainerWidth = document.getElementById('outputTextContainerOuter').style.width;
  if(outputTextContainerWidth == "25%") {
    document.getElementById('sed').style.width='50%';
    document.getElementById('outputPanel').style.width='50%';
    document.getElementById('inputTextContainerOuter').style.width='50%';
    document.getElementById('outputTextContainerOuter').style.width='50%'; 
  } else if ((outputTextContainerWidth == "50%") || (outputTextContainerWidth == '')) {
    document.getElementById('sed').style.width='25%';
    document.getElementById('outputPanel').style.width='75%';
    document.getElementById('inputTextContainerOuter').style.width='25%';
    document.getElementById('outputTextContainerOuter').style.width='75%';
  }
  outputTextContainerMouseOver();
}

// FIXME: catch exceptions  
function parse() {

  require(["ace/ace"], function run(ace) {

  try {
    var sed = document.getElementById('sed');
    var inputText = ace.edit("inputText");
    var outputText = document.getElementById("outputText");

    sed.style.borderLeftWidth = "0px";
    sed.style.backgroundColor = "#fff";

    while (outputText.firstChild) {
     outputText.removeChild(outputText.firstChild);
    }

    var sedTerms = new Array();
    var currChar = null;
    var prevChar = null;
    var term = "";
    var index = 0;
    var db = true;
    for(var i=0; i<sed.value.length; i++) {
      currChar = sed.value[i];
      if(currChar == '\\') {
        db = !db;
      } else if((prevChar == '\\') && (currChar != '\\') && (!db)) {
          db = !db;
      } else if((currChar == '/') && (db)) {
        if(prevChar != null) {
          term = term + prevChar;
        }
        prevChar = null;
        sedTerms[index] = term;
        term = "";
        index++;
        continue;
      } 
      if(prevChar != null) {
         term = term + prevChar;
      }
      prevChar = currChar;
    }

    if(prevChar != null) {
      sedTerms[index] = term + prevChar;
    }

    if(sedTerms.length < 3) {
      outputText.innerText = "";
      document.getElementById("matchCount").innerHTML = '';
      if(sed.value.length > 0) {
        sed.style.borderLeftWidth = "4px";
        sed.style.backgroundColor = "#fff0ee";
      }
      return;
    }

    // Assign terms to variables
    var regex = "";
    var replaceStr = "";
    var modifier = "";

    for(var i=0; i<sedTerms.length; i++) {
      if((i==1) && (typeof sedTerms[i] != 'undefined')) {
        regex = sedTerms[i];
      } else if((i==2) && (typeof sedTerms[i] != 'undefined')) {
        replaceStr = sedTerms[i];
      } else if((i==3) && (typeof sedTerms[i] != 'undefined')) {
        modifier = sedTerms[i];
      }
    }

    // if(regex.length < 1) {
    //   outputText.innerText = inputText.getValue();
    //   return;
    // }

    var inputTextLines = inputText.getValue().split("\n");
    var newOutputText = "";
    var modifierIsNumber;
    if(isNumber(modifier)) {
      modifierIsNumber = true;
      modifier = Number(modifier) - 1;
    } else {
      modifierIsNumber = false;
    }
    var matchCount = 0;
    // Iterate over inputText children, apply regex, set highlight indexes
    for(var i=0; i<inputTextLines.length; i++) {
      var inputTextChild = inputTextLines[i];
      var searchIndexes = {};
      var outputResultFormattedA = "";
      var searchIndex = 0;
      var prevSearchIndex = 0;
      var prevOffset = 0;
      var offset = 0;
      var matches = inputTextChild.match(new RegExp(regex, "g"));
      var splitByMatch = inputTextChild.split(new RegExp(regex, "m"));
      var splitByMatchLength = splitByMatch.length;
      if((splitByMatchLength == 1) && (splitByMatch[0].trim().length < 1)) {
        outputResultFormattedA = splitByMatch[0] + "\n";
      }
      for(var j=0; j<splitByMatchLength; j++) {
        if(modifierIsNumber) {
          if(j == modifier) {
            // if((inputTextChild.search(regex) != -1) && (splitByMatchLength==0)) {
            //   matchCount++;
            //   outputResultFormattedA = outputResultFormattedA + "<span class='highlight'>" + replaceStr + "</span>";
            // }
            outputResultFormattedA = outputResultFormattedA + escapeHtml(splitByMatch[j]);
            
            if(j+1 < splitByMatchLength) {
              matchCount++;
              outputResultFormattedA = outputResultFormattedA + "<span class='highlight'>" + replaceStr + "</span>";
            }
          } else {
            if((matches != null) && (typeof matches[j] != 'undefined')) { 
              outputResultFormattedA = outputResultFormattedA + escapeHtml(splitByMatch[j] + matches[j]);
            } else {
              outputResultFormattedA = outputResultFormattedA + escapeHtml(splitByMatch[j]);
            }
          }
        } else {

          // if((inputTextChild.search(regex) != -1) && (splitByMatchLength==0)) {
            // matchCount++;
            // outputResultFormattedA = outputResultFormattedA + "<span class='highlight'>" + replaceStr + "</span>";
          // } 
          outputResultFormattedA = outputResultFormattedA + escapeHtml(splitByMatch[j]);
        
          if(j+1 < splitByMatchLength) {
            matchCount++;
            outputResultFormattedA = outputResultFormattedA + "<span class='highlight'>" + replaceStr + "</span>";
          }
        }
        // prevSearchIndex = searchIndex;
      }
      document.getElementById("matchCount").innerHTML = matchCount;

      if(outputResultFormattedA.trim().length != 0) {
        newOutputText = newOutputText + outputResultFormattedA + "\n";
      } else {
        newOutputText = newOutputText + outputResultFormattedA;
      }

    } // End of input text for loop

    var pre = document.createElement("pre");
    pre.innerHTML = newOutputText;
    outputText.appendChild(pre);

    sed.style.borderLeftWidth = "0px";
    sed.style.backgroundColor = "#f3ffee";

  } catch(e) {
    if(sed.value.length > 0) {
      sed.style.borderLeftWidth = "4px";
      sed.style.backgroundColor = "#fff0ee";
    }
    document.getElementById("matchCount").innerHTML = '';
  }
  });
}