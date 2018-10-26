<?php include_once 'header.phtml'; ?>

<form>
    <input id="form-login" type="hidden" name="id" value="<?=$data['personne']->getId()?>"/>
    <input type="date" value="Date début">
    <input type="date" value="Date fin">
</form>


<?php include_once 'footer.phtml'; ?>