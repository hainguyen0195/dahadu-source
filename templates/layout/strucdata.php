<?php if(isset($seoDB) && $seoDB['schema'.$seolang]!='') { ?>
    <!-- Product -->
    <script type="application/ld+json">
        <?=htmlspecialchars_decode($seoDB['schema'.$seolang])?>
    </script>
<?php } ?>
<!-- General -->
<script type="application/ld+json">
    {
        "@context" : "https://schema.org",
        "@type" : "Organization",
        "name" : "<?=@$setting['ten'.$lang]?>",
        "url" : "<?=$config_base?>",
        "sameAs" :
        [
            <?php if(isset($social) && count($social) > 0) { $sum_social = count($social); foreach($social as $key => $value) { ?>
                "<?=@$value['link']?>"<?=(($key+1)<$sum_social)?',':''?>
            <?php } } ?>
        ],
        "address":
        {
            "@type": "PostalAddress",
            "streetAddress": "<?=$optsetting['diachi'.$lang]?>",
            "addressRegion": "Ho Chi Minh",
            "postalCode": "70000",
            "addressCountry": "vi"
        }
    }
</script>