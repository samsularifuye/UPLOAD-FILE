<html>
	<title>Upload File Samsul</title> 
		</head> 
		<body>
		<form action="" enctype="multipart/form-data" method="post">
		<table	border="0" >
			<tr> <td> File PDF </td> <td width="15"> : </td> 
				<td> <input id="file" name="file" type="file" accept=".pdf" /> </td> </tr>
			
			<tr> <td> Simpan Sebagai</td> <td width="9"> : </td>
				<td> <input type="text" name="data">   </td>  </tr> </table>

			<input id="Submit" name="submit" type="submit" value="Upload" />
		</form>
	<?php

		if (isset($_POST['submit']))
		{
			$namafile = $_FILES["file"]["name"];
			$simpan = $_POST["data"];
			$file_basename = substr($namafile, 0, strripos($namafile, '.')); 
			$file_basename = "$simpan";
			
			$file_ext = substr($namafile, strripos($namafile, '.')); 
			$filesize = $_FILES["file"]["size"];
			$allowed_file_types = array('.pdf');	

			if (in_array($file_ext,$allowed_file_types) && ($filesize < 5000000))
			{	
				
				$newnamafile = ($file_basename).$file_ext;  
				
				if (file_exists("upload/" . $newnamafile))
				{
					
					echo "File sudah ada.";
				}
				else
				{		
					move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $newnamafile);
					echo "File $file_basename sukses di upload.";		
				}
				
			}
			elseif (empty($file_basename))
			{	
				
				echo "Silahkan Pilih file untuk di upload.";
			} 
			elseif ($filesize > 5000000)
			{	
			
				echo "File ini terlalu besar untuk di Upload, silahkan coba lagi.";
			}
			else
			{
			
				echo " Tipe File yang anda upload tidak sesuai, silahkan masukkan file dengan tipe : " . implode(', ',$allowed_file_types);
				unlink($_FILES["file"]["tmp_name"]);
			}
		}

		?>
	</body>
</html>