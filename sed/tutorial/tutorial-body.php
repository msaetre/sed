    <input id="sed" spellcheck="false" onpaste="parse();" onkeyup="parse();" placeholder="s/xxx/xxx/g" type="text"/>
    <div id="outputPanel">
      <span id="matchCount"></span>
    </div>
    <div id="inputTextContainerOuter" onMouseOver="inputTextContainerMouseOver();" onMouseOut="inputTextContainerMouseOut();">
      <div id="inputTextContainerInner">
        <div id="inputText" onpaste="parse();" onkeyup="parse();"></div>
      </div>
      <input id="inputExpandButton" style="display: none" class="inputExpandButtonActive" type="submit" value=">" onclick="inputExpandClicked();"/>
    </div>
    <div id="outputTextContainerOuter" onMouseOver="outputTextContainerMouseOver();" onMouseOut="outputTextContainerMouseOut();">
      <div id="outputTextContainerInner">
        <div id="outputText"></div> 
      </div>
      <input id="outputExpandButton" style="display: none" class="outputExpandButtonActive" type="submit" value="<" onclick="outputExpandClicked();"/>
    </div>
    <div id="horizontalBorderBottom">
      <div id="importFileArrow" class="arrowUp"></div>
      <div id="exportFileArrow" class="arrowUp"></div>
    </div>
    <div id="inputButtonPanel">
      <input id="importFileButtonVisible" class="bottomButton" value="Import File" type="submit" onclick="document.getElementById('importFileButton').click();" onmouseout="document.getElementById('importFileArrow').style.display='none'" onmouseover="document.getElementById('importFileArrow').style.display='block'"/>
      <input style="display: none" id="importFileButton" type="file" onchange="fileUploaded(this.files[0]);"/>
    </div>
    <div id="outputButtonPanel">
      <input id="exportFileButtonVisible" class="bottomButton" value="Export .txt" onmouseout="document.getElementById('exportFileArrow').style.display='none'" onmouseover="document.getElementById('exportFileArrow').style.display='block'" type="submit" onclick="exportToFile();"/>
    </div>
    <script>
        require(["ace/ace"], function test(ace) {
          var inputText = ace.edit("inputText");
          inputText.renderer.setShowGutter(false); 
          inputText.renderer.setScrollMargin(5, 5, 0, 0); 
          inputText.focus();
          inputText.getSession().setTabSize(2);
          inputText.renderer.setPadding(10);
          inputText.setDisplayIndentGuides(false);
        });
    </script>