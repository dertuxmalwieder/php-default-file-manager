<form action="index.php" method="post">
    <input type="hidden" name="mode" value="createfile" />
    <table cellspacing="3px">
    <tr>
    <td>.exe file:</td>               <td><input name="apppath" size="30" /></td>             <td class="expl">(ex.: C:\Program Files\xplorer2\xplorer2_UC.exe)</td>
    </tr><tr>
    <td>Name of the file manager:</td><td><input name="appname" size="30" /></td>             <td class="expl">(to be shown in context menu; ex.: xplorer²)</td>
    </tr><tr>
    <td>Parameters:</td>              <td><input name="appparams" size="30" value="%1" /></td><td class="expl">(see your FM's manual for a list of available parameters)</td>
    </tr>
    </table>
    <br />
	Available variables for parameters:<br />
    %1 &bull; complete path to the folder to open<br />
	<br />
        <input type="checkbox" name="safemode" /> Assign the file manager to Directories, not to Folders<br />
        Experimental: Use this checkbox to keep My Computer, the Bin et al. unchanged.<br />
        <br />
        <input type="checkbox" name="64bit" /> 64-bit Windows<br />
        Create .reg files that work on 64-bit Windows systems. (Different registry structure.)<br />
        <br />
	<input type="submit" value="Create the .reg files!" />
</form>
