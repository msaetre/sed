   <div id="tutorialContent">
     <h1 class="tutorialHeader">REGULAR EXPRESSIONS</h1>
     <section class="tutorialSection">
     <article>
       <h2 style="margin-top: 0.5em">What is RegEx?</h2>
       <p>A regular expression is simply a sequence of characters that represent a pattern to match.
          Consider the following RegEx as a basic example:</p>
       <div>
         <span class="codeExample">
         ^<span style="color:#29F41A">m</span><span style="color:#F4F41A">.*</span><span style="color:#1AF4F4">s</span><span style="color:#F4A4FA">$</span>
         </span>
       </div>

       <p>Let's break down this example:</p>

       <ul>
          <li>The '<strong>^</strong>' is a metacharacter (character with a special meaning) that matches the beginning of a line</li>
          <li>The '<strong>m</strong>' simply matches an 'm' character</li>
          <li>The '<strong>.</strong>' is a metacharacter that matches any character</li>
          <li>The '<strong>*</strong>' is a metacharacter that matches 0 or more of the previously specified character</li>
          <li>The '<strong>s</strong>' matches an 's' character</li>
          <li>The '<strong>$</strong>' is a metacharacter that matches the end of a line</li>
       </ul>

       <p>Here are a few lines that the previous RegEx <span style="font-style: italic">would</span> match:</p>

       <div>
         <span class="codeExample">
           <div><span class="highlight">mars</span></div>
           <div><span class="highlight">many people like perogies</span></div>
           <div><span class="highlight">m s s</span> a a</div>
         </span>
       </div>   

       <p>Here are a few lines that the previous RegEx <span style="font-style: italic">would not</span> match:</p>
    
       <div>
         <span class="codeExample">
           <div>master <span style="font-size: 80%; font-style: italic; color: #999">(The 's' is not just before the end of the line)</span></div>
           <div>Mars <span style="font-size: 80%; font-style: italic; color: #999">(The 'M' is upper case)</span></div>
           <div>animals <span style="font-size: 80%; font-style: italic; color: #999">(The 'm' needs to be the first character)</span></div>
         </span>
       </div>

       <p>You might now be wondering how to match a '<strong>^</strong>' or '<strong>*</strong>' character, without the RegEx pattern treating
       it as a metacharacter.  The answer is by using what is called an escape character.  While some 
       applications will allow you to specify the escape character to use, the '<strong>\</strong>' character is used in 
       the world of regular expressions.  Let's take a look at another, more complex example:</p>

       <div>
         <span class="codeExample">
           [<span style="color:#29F41A">A</span>-<span style="color:#29F41A">Z</span><span style="color:#F4F41A">a</span>-<span style="color:#F4F41A">z</span><span style="color:#1AF4F4">0</span>-<span style="color:#1AF4F4">9</span>]<span style="color:#F4A4FA">+</span>@[<span style="color:#29F41A">A</span>-<span style="color:#29F41A">Z</span><span style="color:#F4F41A">a</span>-<span style="color:#F4F41A">z</span><span style="color:#1AF4F4">0</span>-<span style="color:#1AF4F4">9</span>]<span style="color:#F4A4FA">+</span>\.[<span style="color:#29F41A">A</span>-<span style="color:#29F41A">Z</span><span style="color:#F4F41A">a</span>-<span style="color:#F4F41A">z</span><span style="color:#1AF4F4">0</span>-<span style="color:#1AF4F4">9</span>]<span style="color:#F4A4FA">+</span>
         </span>
       </div>

       <p>Breakdown:</p>

       <ul>
          <li>The '<strong>[</strong>' is a metacharacter that represents the beginning of a bracket expression</li>
          <li>The '<strong>A-Z</strong>' within the bracket expression indicates a range ('-') of possible characters matches between 'A' and 'Z'.  The range still only refers to one character, but any between 'A' and 'Z' are allowed</li>
          <li>The '<strong>a-z</strong>' indicates a range of characters between 'a' and 'z'</li>
          <li>The '<strong>0-9</strong>' indicates a range of numbers between '0' and '9'</li>
          <li>The '<strong>]</strong>' is a metacharacter that represents the end of a bracket expression</li>
          <li>The '<strong>+</strong>' is a metacharacter that tells the parser to match one or more of any allowed characters specified by the previous bracket expression</li>
          <li>The '<strong>@</strong>' matches an '@' character</li>
          <li>The '<strong>\.</strong>' matches a literal '.' character, since it is escape with a '\'</li>
       </ul>

       <p>Here are a few lines that the previous RegEx <span style="font-style: italic">would</span> match:</p>

       <div>
         <span class="codeExample">
           <div><span class="highlight">me@example.com</span></div>
           <div><span class="highlight">test123@example.com</span></div>
           <div>ME_<span class="highlight">123@example.com</span></div>
         </span>
       </div> 

       <p>Here are a few lines that the previous RegEx <span style="font-style: italic">would not</span> match:</p>

       <div>
         <span class="codeExample">
           <div>me_@example.com</div>
           <div>me@example_com</div>
           <div>@example.com</div>
         </span>
       </div> 

     </article>
     </section>
   </div>