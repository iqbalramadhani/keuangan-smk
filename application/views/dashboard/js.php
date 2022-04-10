<script>
    $(document).ready(function() {
        $('#tambah-data').click(function() {
            window.location.href = current_location + '/form';
        });
    });


    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
        oFReader.onload = function(oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };
</script>