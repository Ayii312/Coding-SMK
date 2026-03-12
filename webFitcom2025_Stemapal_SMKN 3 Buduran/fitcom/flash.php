<?php 
$ok=flash('ok');
$err=flash('err');
if($ok):?>
    <div class="alert alert-success"><?=e($ok)?></div>    
<?php 
    endif;
if($err):?>
<div class="alert alert-danger"><?=e($err)?></div>
<?php endif; ?>
