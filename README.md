Apk to dex file converter useing php

how to use:

1. first create your project apk in android studio and go to your apk directory
2. download the project and drop your apk file to run.bat file
3. your dex file create in apk directory

attension: this is content of run.bat

<pre>
@ECHO OFF
php E:\My_Projects\php\dex-minifier\command.php minify-dex %1
REM php E:\My_Projects\php\dex-minifier\command.php minify-dex E:\My_Projects\php\dex-minifier\temp\app-debug.apk
PAUSE
</pre>

you must enter directory of this project in your pc in run.bat file (in line 2 and 3) for example:

<pre>
@ECHO OFF
php C:\Example\dex-minifier\command.php minify-dex %1
REM php C:\Example\dex-minifier\command.phpcommand.php minify-dex C:\Example\dex-minifier\command.php\temp\app-debug.apk
PAUSE
</pre>
