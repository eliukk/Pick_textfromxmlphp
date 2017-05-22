# Pick_textfromxmlphp

Pick_TextFromXml class reads single or multiple xml files and extracts texts from files.
Available command line parameters are: inputfile (i=) outputfile(o=) and
directory(a=). If outputfile is not defined inputfile name is used, but ".xml"
is renamed to "_raw.txt" so that it generates text file. If outputfile is "stdout"
class prints results to console and does not generate text files.
 
Usage examples: 
Extracts single xml file from given inputPath. Writes extracted texts to text file.
"C:\php\php.exe" "C:\Users\%USERPROFILE%\Documents\NetBeansProjects\Pick_TextFromXmlPhp\index.php" i=Z:\\nlf_ocrdump_v0-21_newspapers_1771-1870fin\\1771-1870\\fin\\1775\\1457-4683_1775-09-01_0_001.xml
 
Extracts single xml file from given inputPath. Writes extracted texts to console.
"C:\php\php.exe" "C:\Users\%USERPROFILE%\Documents\NetBeansProjects\Pick_TextFromXmlPhp\index.php" o=stdout i=Z:\\nlf_ocrdump_v0-21_newspapers_1771-1870fin\\1771-1870\\fin\\1775\\1457-4683_1775-09-01_0_001.xml
 
Extracts all xml files from given inputPath. Writes extracted texts to text files.
"C:\php\php.exe" "C:\Users\%USERPROFILE%\Documents\NetBeansProjects\Pick_TextFromXmlPhp\index.php" a=true i=Z:\\nlf_ocrdump_v0-21_newspapers_1771-1870fin\\1771-1870\\fin\\1775\\
