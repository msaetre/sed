   <div id="tutorialContent">
     <h1 class="tutorialHeader">SED INTRODUCTION</h1>
     <section class="tutorialSection">
     <article>
       <h2 style="margin-top: 0.5em">What is sed?</h2>
       <p>sed (stream editor) is a powerful command line tool used for editing data streams.
       	  Despite it being developed quite some time ago, it remains a commonly used application
       	  by those who appreciate and understand its power.  The tool itself can be quite daunting and easy to ignore at first glance, but pushing through the small learning curve can save you a lot of tedious work in the future.
       </p>
     </article>
     <article>
       <h2>Regular Expressions (RegEx/RegExp)</h2>
       <p>In order to master sed, you must first master regular expressions.  For a quick overview
       	  on regular expressions, take a look at the RegEx section.
       </p>
     </article>
     <article>
       <h2>Sed Expressions (sed -e)</h2>
       <p>The expression passed in as a parameter tells sed what to do.  Here is the basic structure for an expression:</p>
          <div><span class="codeExample">sed -e <span style="color:#29F41A">{command}</span>/<span style="color:#F4F41A">{regex}</span>/<span style="color:#1AF4F4">{replacement}</span>/<span style="color:#F4A4FA">{pattern_flag}</span></span></div>
 		   <p>Let's break down this expression structure:</p>
 		   <dl>
 		    <dt>{command}</dt>
  			  <dd>A character that refers to the type of operation that will be performed</dd>
  			<dt>{regex}</dt>
  			  <dd>A regular expression that determines which parts of the stream will be matched</dd>
  			<dt>{replacement}</dt>
  			  <dd>String to replace the matching portions of the stream with (optional depending on the command)</dd>
  			<dt>{pattern_flag}</dt>
  			  <dd>A character/number that typically indicates how to perform the regex match or replacement substitution</dd>
		    </dl>
      </article>
      <article>
       <h2>Sed Commands</h2>
       <p>The command you are likely to use the most (by far) is the substitution ('s') command.  
       	  It simply tells sed to substitute whatever pattern the 
       	  <span style="font-style: italic; font-weight: bold">{regex}</span> string matches with the given 
       	  <span style="font-style: italic; font-weight: bold">{replacement}</span> string.  Depending on the 
       	  <span style="font-style: italic; font-weight: bold">{pattern_flag}</span> provided, the substitution 
       	  can occur globally ('g'), first match per line only ('1'), second match per line only ('2'), etc.  
       </p>
      </article>
      <article>
          <h2>Example 1</h2>
          <p>The following example simply tells sed to find all the occurrences of the word 'apple' and replace 
       	     them with 'orange':</p>

	      <h3>test.txt</h3>
	      <div>
	    	<span class="codeExample" style="margin-top: 0">
	          <div>First line has apples.</div>                      
	          <div>More apples on the apples second line.</div>
	        </span>
	      </div>

	      <div>
	        <span class="codeExample" style="margin-top: 0">
	          sed -e <span style="color:#29F41A">s</span>/<span style="color:#F4F41A">apple</span>/<span style="color:#1AF4F4">orange</span>/<span style="color:#F4A4FA">g</span> test.txt
	        </span>
	      </div>

	      <h3>Result:</h3>
	      <div>
	        <span class="codeExample" style="margin-top: 0; margin-bottom: 0">
	          <div>First line has <span class="highlight">orange</span>s.</div>                      
	          <div>More <span class="highlight">orange</span>s on the <span class="highlight">orange</span>s second line.</div>
	        </span>
	      </div>
      </article>
      <article>
       <h2 style="margin-top: 1.2em">Example 2</h2>
       <p>The next example tells sed to find the <span style="font-style: italic">third</span> occurrence of the word 'div' and replace it with 'span':</p>    
	     <h3>test.txt</h3>
	     <div>
	       <span class="codeExample" style="margin-top: 0">
			 <div>&lt;div&gt;banana&lt;/div&gt; &lt;div&gt;mango&lt;/span&gt;</div>
			 <div>&lt;div&gt;tomato&lt;/div&gt; &lt;div&gt;grape&lt;/span&gt;</div>
	       </span>
	     </div>
         <div>
       	   <span class="codeExample" style="margin-top: 0">
             sed -e <span style="color:#29F41A">s</span>/<span style="color:#F4F41A">div</span>/<span style="color:#1AF4F4">span</span>/<span style="color:#F4A4FA">3</span> test.txt
           </span>
         </div>
         <h3>Result:</h3>
         <div>
           <span class="codeExample" style="margin-top: 0">
		     <div>&lt;div&gt;banana&lt;/div&gt; &lt;<span class="highlight">span</span>&gt;mango&lt;/span&gt;</div>
		     <div>&lt;div&gt;tomato&lt;/div&gt; &lt;<span class="highlight">span</span>&gt;grape&lt;/span&gt;</div>
           </span>
         </div>
     </article>
   </section>
   </div>