<?php 
if($_SESSION['usertype'] == 'admin')
{
  echo "Admin Area | $namatoko";
}
if($_SESSION['usertype'] == 'superadmin')
{
  echo "Super Admin Area | $namatoko";
}
?>