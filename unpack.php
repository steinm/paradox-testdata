#!/usr/local/bin/php -f
<?php
$fp = fopen($_SERVER["argv"][1], "r");
if(!$fp) {
	echo "Fehler beim Öffnen der Datei '".$_SERVER["argv"][1]."'\n";
	exit(1);
}

$header = fread($fp, 0x58);
$format = "vrecordSize/";
$format .= "vheaderSize/";
$format .= "CfileType/";
$format .= "CmaxTableSize/";
$format .= "VnumRecords/";
$format .= "vnextBlock/";
$format .= "vfileBlocks/";
$format .= "vfirstBlock/";
$format .= "vlastBlock/";
$format .= "vunknown0x12/";
$format .= "CmodifiedFlags1/";
$format .= "CindexFieldNumber/";
$format .= "VprimaryIndexWorkspace/";
$format .= "Vunknown0x1A/";
$format .= "vindexRoot/";
$format .= "CnumIndexLevels/";
$format .= "vnumFields/";
$format .= "vprimaryKeyFields/";
$format .= "Vencryption1/";
$format .= "CsortOrder/";
$format .= "CmodifiedFlags2/";
$format .= "Cunknown0x2B/";
$format .= "Cunknown0x2C/";
$format .= "CchangeCount1/";
$format .= "CchangeCount2/";
$format .= "Cunknown0x2F/";
$format .= "VtableNamePtrPtr/";
$format .= "VfieldInfoPtr/";
$format .= "CwriteProtected/";
$format .= "CfileVersionID/";
$format .= "vmaxBlocks/";
$format .= "Cunknown0x3C/";
$format .= "CauxPasswords/";
$format .= "Cunknown0x3E/";
$format .= "Cunknown0x3F/";
$format .= "VcryptInfoStartPtr/";
$format .= "VcryptInfoEndPtr/";
$format .= "Cunknown0x48/";
$format .= "VautoInc/";
$format .= "vfirstFreeBlock/";
$format .= "CindexUpdateRequired/";
$format .= "Cunknown0x50/";
$format .= "Cunknown0x51/";
$format .= "Cunknown0x52/";
$format .= "Cunknown0x53/";
$format .= "Cunknown0x54/";
$format .= "CrefIntegrity/";
$format .= "Cunknown0x56/";
$format .= "Cunknown0x57/";
$headerarr1 = unpack($format, $header);
print_r($headerarr1);

$header = fread($fp, 0x20);
$format = "vunknown0x58/";
$format .= "vunknown0x5A/";
$format .= "Vencryption2/";
$format .= "VfileUpdateTime/";
$format .= "vhiFieldID/";
$format .= "vhiFieldID2/";
$format .= "vsometimesNumFields?/";
$format .= "vdosGlobalCodePage/";
$format .= "Cunknown0x6C/";
$format .= "Cunknown0x6D/";
$format .= "Cunknown0x6E/";
$format .= "Cunknown0x6F/";
$format .= "vchangeCount4/";
$format .= "Cunknown0x72/";
$format .= "Cunknown0x73/";
$format .= "Cunknown0x74/";
$format .= "Cunknown0x75/";
$format .= "Cunknown0x76/";
$format .= "Cunknown0x77/";
$headerarr2 = unpack($format, $header);
print_r($headerarr2);

$header = fread($fp, $headerarr1["numFields"]*6+4+79);
$format = "";
for($i=1; $i<=$headerarr1["numFields"]; $i++)
	$format .= "Cfield".$i."_type/Cfield".$i."_size/";
$format .= "VtableNamePtr/";
for($i=1; $i<=$headerarr1["numFields"]; $i++)
	$format .= "VfieldNamePtrArray".$i."/";
$format .= "a79tableName/";
$headerarr3 = unpack($format, $header);
print_r($headerarr3);
$i = 1;
while($i <= $headerarr1["numFields"]) {
	$name = "";
	do {
		$char = fgetc($fp);
		if(ord($char) != 0)
			$name .= $char;
	} while(ord($char) != 0);
	$fieldnames[] = $name;
	$i++;
}
print_r($fieldnames);

fclose($fp);
?>
