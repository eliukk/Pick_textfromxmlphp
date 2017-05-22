
<?php
/*
 * Pick_TextFromXml class reads single or multiple xml files and extracts texts from files.
 * Available command line parameters are: inputfile (i=) outputfile(o=) and
 * directory(a=). If outputfile is not defined inputfile name is used, but ".xml"
 * is renamed to "_raw.txt" so that it generates text file. If outputfile is "stdout"
 * class prints results to console and does not generate text files.
 * 
 * Usage examples:
 * 
 * Extracts single xml file from given inputPath. Writes extracted texts to text file.
 * "C:\php\php.exe" "C:\Users\%USERPROFILE%\Documents\NetBeansProjects\Pick_TextFromXmlPhp\index.php" i=Z:\\nlf_ocrdump_v0-21_newspapers_1771-1870fin\\1771-1870\\fin\\1775\\1457-4683_1775-09-01_0_001.xml
 * 
 * Extracts single xml file from given inputPath. Writes extracted texts to console.
 * "C:\php\php.exe" "C:\Users\%USERPROFILE%\Documents\NetBeansProjects\Pick_TextFromXmlPhp\index.php" o=stdout i=Z:\\nlf_ocrdump_v0-21_newspapers_1771-1870fin\\1771-1870\\fin\\1775\\1457-4683_1775-09-01_0_001.xml
 * 
 * Extracts all xml files from given inputPath. Writes extracted texts to text files.
 * "C:\php\php.exe" "C:\Users\%USERPROFILE%\Documents\NetBeansProjects\Pick_TextFromXmlPhp\index.php" a=true i=Z:\\nlf_ocrdump_v0-21_newspapers_1771-1870fin\\1771-1870\\fin\\1775\\
 */


/*
 * Parses command line arguments for inputPath(i), outputPath(o) and
 * directory(a). if directory is defined all xml files from defined directory
 * and from it's possible subfolders are extracted by extractAll function.  
 * If directory is not defined only one xml file is extracted by parseXmlFile
 * function.
 */

parse_str(implode('&', array_slice($argv, 1)), $_GET);

$inputPath = $_GET['i'];
$outputPath = $_GET['o'];
$directory = $_GET['a'];

$pickText = new Pick_TextFromXml();

if ($directory !== null){
    $pickText->extractAll($inputPath, $outputPath);
}
else{
    $pickText->parseXmlFile($inputPath, $outputPath);
}

class Pick_TextFromXml{

    /*
     * Parses xml file from given inputPath and writes text file that contains
     * all the texts from given xml file or writes texts to console if outputPath is "stdout".
     * 
     */
    
    function parseXmlFile($inputPath, $outputPath){
        
        $contents = '';
        
        $dom = new DOMDocument;
        $dom->load($inputPath);
        
        $strings = $dom->getElementsByTagName('String');
        
        foreach ($strings as $string) {
            $contents .= $string->getAttribute('CONTENT') . PHP_EOL;
        }
        
        if ($outputPath === null) {
            $outputPath = str_replace(".xml","_raw.txt",$inputPath);
        }

        if (strcmp($outputPath, "stdout") === 0) {
            print $contents;
        } 
        else {
            $contentFile = fopen($outputPath, "w") or die("Unable to open file!");
            fwrite($contentFile, $contents);
            fclose($contentFile);
            
            print "File " . $outputPath . " written." . PHP_EOL;
        }
    }
    
    /*
     * Extracts texts from all xml files from given inputPath. Goes also through 
     * subdirectories.
     */
    
    function extractAll($inputPath, $outputPath){
        
        $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($inputPath));

        foreach ($rii as $file) {

            if ($file->isDir()){ 
                continue;
            }
            
            $filePath = $file->getPathname();
            
            if (strpos($filePath, '.xml') !== false) {
                $this->parseXmlFile($filePath, $outputPath);
            }
        }
    }
}

