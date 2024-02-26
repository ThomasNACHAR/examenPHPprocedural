<?php
/* Smarty version 3.1.48, created on 2024-02-26 17:24:29
  from '/Applications/MAMP/htdocs/examenPHPprocedural/template/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_65dcc94dc02f06_57314789',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '12632f17f1857d4fce164acc121527ebea8dde7c' => 
    array (
      0 => '/Applications/MAMP/htdocs/examenPHPprocedural/template/index.tpl',
      1 => 1708968246,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65dcc94dc02f06_57314789 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des fichiers</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="file-list-container">
    <nav>
            <a href="?route=logout">Se déconnecter</a>
        </nav>
        <h2>Liste des fichiers</h2>
        <ul>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['fichiers']->value, 'fichier');
$_smarty_tpl->tpl_vars['fichier']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fichier']->value) {
$_smarty_tpl->tpl_vars['fichier']->do_else = false;
?>
            <li><a href="upload/<?php echo $_smarty_tpl->tpl_vars['fichier']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['fichier']->value;?>
</a></li>
          <?php
}
if ($_smarty_tpl->tpl_vars['fichier']->do_else) {
?>
            Pas de fichier
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          <a href="?route=upload" class="button">Ajouter des fichiers</a>
        </ul>
    </div>
</body>
</html>
<?php }
}
