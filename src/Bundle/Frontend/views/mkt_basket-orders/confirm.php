<form name="redirect" id="redirect-form" method="post" action="<?= $this->redirectUrl; ?>"
      target="<?= $this->redirectTarget; ?>">
    <input type="submit" name="Click here to redirect"/>
</form>
<script type="text/javascript">
    document.forms["redirect"].submit()
</script> 