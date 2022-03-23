<script>
    let module = '<?= $module; ?>';
    let no=2;

    $(document).ready(function() {
        console.log('ini');
        $('#tambah-data').click(function() {window.location.href = base_url() + module + '/form';});

        $('.input-date').datepicker({format: 'dd-mm-yyyy'});

        $(document).on('keyup','.nominal',function(){$(this).val(formatRupiah($(this).val()));})

        $('#add-button').click(function(){
            let table = `<tr id="row-${no}">
                <td><input type="text" name="nama[]" class="form-control" required></td>
                <td><input type="text" name="nis[]" class="form-control" required></td>
                <td><select name="bulan[]" id="" class="form-control">
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </td>
                <td><input type="text" name="tgl_bayar[]" class="form-control input-date" readonly required></td>
                <td><input type="text" name="nominal[]" id="" class="form-control nominal"></td>
                <td><button class="btn btn-danger hapus" data-row="row-${no}" type="button">Hapus</button> </td>
            </tr>`;
            no++;
            $('#table-data').append(table);
            $('.input-date').datepicker({format: 'dd-mm-yyyy'});
        });

        $(document).on('click','.hapus',function(){
            $('#'+$(this).data('row')).remove();
        });

        $(document).on('click','.form-check-input',function(){
            $('.input-form').hide();
            let id = $(this).data('id');
            if(id=='manual'){
                $('.manual-required').attr('required',true);
                $('.import-required').attr('required',false);
                $('#inlineRadio1').prop(true);
            }else{
                $('.manual-required').attr('required',false);
                $('.import-required').attr('required',true)
                $('#inlineRadio2').prop(true);
            }
            $('#'+id).show();
        });

    });
</script>