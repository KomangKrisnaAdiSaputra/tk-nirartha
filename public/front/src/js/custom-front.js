$(document).ready(function(){
    let url = $("#url").val();
    function tambah_cart_pesanan(kode_kulkul, kode_ukuran, quantity_kulkul){
        $.ajax({
            type:"POST",
            url:url+"/pemesanan/tambah_cart_pesanan",
            dataType:"JSON",
            data:{kode_kulkul:kode_kulkul, kode_ukuran:kode_ukuran, quantity_kulkul:quantity_kulkul},
            success:function(respon){
                if (respon.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Produk kulkul belum bisa dipesan!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }else{
                    tampil_total_cart_pelanggan();
                }
            }
        });
    }
    function tampil_total_cart_pelanggan() {
        $.ajax({
            type:"POST",
            url:url+"/pemesanan/tampil_total_cart",
            dataType:"JSON",
            success:function(respon){
                if (respon.error == false) {
                    if ($("#tampilTotal-cartPelanggan").length != 0) {
                        $("#tampilTotal-cartPelanggan").text(respon.message);
                    }
                    $("#canvasTotal-cartPelanggan").append("<span class='cart' id='tampilTotal-cartPelanggan'>"+respon.message+"</span>");
                }
            }
        });
    }
    function hitung_harga_cart_pelanggan(kode_daftar, jumlah_kulkul){
        $.ajax({
            type:"POST",
            url:url+"/produk/tampil_harga_produk",
            dataType:"JSON",
            data:{kode_daftar:kode_daftar},
            success:function(respon){
                if (respon.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Quantity produk belum bisa dirubah!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }else{
                    let total_harga = parseInt(respon.harga_produk['harga_ukuran']) * jumlah_kulkul;
                    let total_ongkir = parseInt(respon.ongkir_produk['ongkir_ukuran']) * jumlah_kulkul;
                    edit_cart_pelanggan(kode_daftar, total_harga, total_ongkir, jumlah_kulkul);
                }
            }
        });
    }
    function edit_cart_pelanggan(kode_daftar, total_harga, total_ongkir, jumlah_kulkul) {
        $.ajax({
            type:"POST",
            url:url+"/pemesanan/edit_cart_pelanggan",
            dataType:"JSON",
            data:{kode_daftar:kode_daftar, total_harga:total_harga, total_ongkir:total_ongkir, jumlah_kulkul:jumlah_kulkul},
            success:function(respon){
                if (!respon.error) {
                    $("#input-quantity"+kode_daftar).val(jumlah_kulkul); 
                    let username_pelanggan = $("#kode-pelanggan").val();
                    edit_tota_cart(username_pelanggan);
                }
            }
        });
    }
    function edit_tota_cart(username_pelanggan){
        $.ajax({
            type:"POST",
            url:url+"/pemesanan/tampil_total_harga_cart_pelanggan",
            dataType:"JSON",
            data:{username_pelanggan:username_pelanggan},
            success:function(respon){
                if (!respon.error) {
                    $(".total-item-cart-pelanggan").text(respon.total_item+" item");
                    $(".total-harga-cart-pelanggan").text("Rp. "+parseInt(respon.total_harga[0]['total_harga_kulkul']).toLocaleString());
                    $(".total-ongkir-cart-pelanggan").text("Rp. "+parseInt(respon.total_ongkir[0]['total_ongkir_kulkul']).toLocaleString());
                }
            }
        });
    }
    function hapus_cart_pelanggan(kode_daftar, username_pelanggan){
        $.ajax({
            type:"POST",
            url:url+"/pemesanan/hapus_cart_pelanggan",
            dataType:"JSON",
            data:{kode_daftar:kode_daftar},
            success:function(respon){
                if (!respon.error) {
                    $("#item"+kode_daftar).remove();
                    if ($(".item-cart-pelanggan").length == 0) {
                        location.reload(true);
                        return;
                    }
                    edit_tota_cart(username_pelanggan);
                    tampil_total_cart_pelanggan();
                }
            }
        });
    }
    function tambah_pemesanan_pelanggan(form_pemesanan) {
        $.ajax({
            type:"POST",
            url:url+"/pemesanan/tambah_pemesanan_pelanggan",
            dataType:"JSON",
            contentType: false,
            processData: false,
            data:form_pemesanan,
            success:function(respon){
                if (respon.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Pesanan belum bisa disimpan!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }else{
                    tambah_transaksi_pelanggan(respon.message);
                }
            }
        });
    }
    function tambah_transaksi_pelanggan(kode_pemesanan){
        $.ajax({
            type:"POST",
            url:url+"/transaksi/tambah_transaksi_pelanggan",
            dataType:"JSON",
            data:{kode_pemesanan:kode_pemesanan},
            success:function(respon){
                if (respon.error == false) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Pesanan berhasil disimpan!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    window.location.href = url+"/pemesanan/daftar_pesanan";
                }
            }
        });
    }
    function validasi_checkout_pemesanan(kode_pemesanan) {
        $.ajax({
            type:"POST",
            url:url+"/transaksi/validasi_checkout_pemesanan",
            dataType:"JSON",
            data:{kode_pemesanan:kode_pemesanan},
            success:function(respon){
                if (respon.error == true) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Pesanan belum bisa dibayar, karena sedang diverifikasi!',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }else{
                    window.location.href = url+"/pemesanan/pembayaran/"+kode_pemesanan;
                }
            }
        });
    }
    function pembayaran_pemesanan_pelanggan(form_pembayaran) {
        $.ajax({
            type:"POST",
            url:url+"/transaksi/pembayaran_pemesanan_pelanggan",
            dataType:"JSON",
            contentType: false,
            processData: false,
            data:form_pembayaran,
            success:function(respon){
                if (respon.error == true) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Pembayaran gagal disimpan!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }else{
                    Swal.fire({
                        icon: 'success',
                        title: 'Pembayaran berhasil disimpan!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    location.reload(true);
                }
            }
        });
    }
    function batal_pemesanan_pelanggan(kode_pemesanan) {
        $.ajax({
            type:"POST",
            url:url+"/pemesanan/batal_pemesanan_pelanggan",
            dataType:"JSON",
            data:{kode_pemesanan:kode_pemesanan},
            success:function(respon){
                if (respon.error == true) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Pemesanan tidak dapat dibatalkan!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }else{
                    Swal.fire({
                        icon: 'success',
                        title: 'Pemesanan berhasil dibatalkan!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    location.reload(true);
                }
            }
        });
    }
    function selesai_pemesanan_pelanggan(kode_pemesanan, ulasan_pemesanan) {
        $.ajax({
            type:"POST",
            url:url+"/pemesanan/selesai_pemesanan_pelanggan",
            dataType:"JSON",
            data:{kode_pemesanan:kode_pemesanan, ulasan_pemesanan:ulasan_pemesanan},
            success:function(respon){
                if (respon.error == true) {
                    if (respon.message != "") {
                        $("#inputUlasan-ulasanPemesanan").addClass("is-invalid");
                        $("#errorInputUlasan-ulasanPemesanan").text(respon.message['ulasan_pemesanan']);
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Pemesanan tidak dapat dirubah!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }else{
                    Swal.fire({
                        icon: 'success',
                        title: 'Pemesanan terkonfirmasi diterima!',
                        showConfirmButton: false,
                        timer: 1800
                    });
                    location.reload(true);
                }
            }
        });
    }
    $(".btn-logout-pengguna").click(function(){
        Swal.fire({
            title: 'Apa kamu yakin?',
            text: "Pilih 'Keluar' jika kamu siap untuk mengakhiri sesi kamu saat ini",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#335AFF',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yaa, Keluar!',
            cancelButtonText: 'Kembali'
        }).then((result) => {
            if (result.isConfirmed) {
                location = url+'/autentikasi/proses_keluar';
            }
        });
    });
    // pemesanan
    $("#inputFoto-pesananPelanggan").on('change', function () {
        $("#img-foto-pesanan").remove();
        let reader = new FileReader();
        reader.onload = function(){
            let data_profile = "<img src='"+reader.result+"' class='img-fluid rounded-4 py-2' id='img-foto-pesanan' alt='foto pesanan'>";
            $("#canvas-foto-pesanan").prepend(data_profile);
        }
        reader.readAsDataURL(this.files[0]);
    });
    $("#btnQuantity-detailProduk").on('click', '.minus', function(){
        let quantity = parseInt($("#input-quantity").val());
        if (quantity > 1) {
            quantity -= 1;
            $("#input-quantity").val(quantity);
            let harga_ukuran = parseInt($("#input-harga-ukuran-kulkul").val()) * quantity;
            $("#harga-kulkul").text(harga_ukuran.toLocaleString());
        }
    });
    $("#btnQuantity-detailProduk").on('click', '.plus', function(){
        let quantity = parseInt($("#input-quantity").val());
        if (quantity >= 1) {
            quantity += 1;
            $("#input-quantity").val(quantity);
            let harga_ukuran = parseInt($("#input-harga-ukuran-kulkul").val()) * quantity;
            $("#harga-kulkul").text(harga_ukuran.toLocaleString());
        }
    });
    $("#sizes-kulkul").on('click', '.sizes-all', function(){
        $(".sizes-all").removeClass('active');
        $(this).addClass('active');
        let kode_sizes  = $(this).val();
        let harga_sizes = $(this).children(".harga-ukuran-kulkul").val();
        $("#input-kode-ukuran-kulkul").val(kode_sizes);
        $("#input-harga-ukuran-kulkul").val(harga_sizes);
        // set total harga kulkul
        let harga_ukuran = parseInt(harga_sizes) * parseInt($("#input-quantity").val());
        $("#harga-kulkul").text(harga_ukuran.toLocaleString());
    });
    $("#btn-tambah-cart-pesanan").click(function(){
        let kode_kulkul = $("#input-kode-kulkul").val();
        let kode_ukuran_kulkul = $("#input-kode-ukuran-kulkul").val();
        let quantity_kulkul = $("#input-quantity").val();
        tambah_cart_pesanan(kode_kulkul, kode_ukuran_kulkul, quantity_kulkul);
    });
    $("#canvas-cartPelanggan").on('click', '.minus', function(){
        let kode_daftar = $(this).val();
        let quantity = parseInt($("#input-quantity"+kode_daftar).val());
        if (quantity > 1) {
            quantity -= 1;
            hitung_harga_cart_pelanggan(kode_daftar, quantity);
        }
    });
    $("#canvas-cartPelanggan").on('click', '.plus', function(){
        let kode_daftar = $(this).val();
        let quantity = parseInt($("#input-quantity"+kode_daftar).val());
        if (quantity >= 1) {
            quantity += 1;
            hitung_harga_cart_pelanggan(kode_daftar, quantity);
        }
    });
    $("#canvas-cartPelanggan").on('click', '.btn-deleteCartPelanggan', function(){
        let kode_daftar = $(this).val();
        Swal.fire({
            title: 'Apa kamu yakin?',
            text: "Hapus produk dari daftar cart?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#435ebe',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yaa, hapus produk!',
            cancelButtonText: 'Kembali'
        }).then((result) => {
            if (result.isConfirmed) {
                let username_pelanggan = $("#kode-pelanggan").val();
                hapus_cart_pelanggan(kode_daftar, username_pelanggan);
            }
        });
    });
    $("#btnCart-simpanPesananPelanggan").click(function(){
        let form_pemesanan = new FormData();
        form_pemesanan.append('username_pelanggan', $("#kode-pelanggan").val());
        form_pemesanan.append('deskripsi_pesanan', $("#inputDeskripsi-pesananPelanggan").val());
        form_pemesanan.append('foto_pesanan', $("#inputFoto-pesananPelanggan")[0].files[0])
        tambah_pemesanan_pelanggan(form_pemesanan);
    });
    $("#canvasOrder-daftarPesanan").on('click', '.btnOrder-checkoutPemesananPelanggan', function(){
        let kode_pemesanan = $(this).val();
        validasi_checkout_pemesanan(kode_pemesanan);
    });
    $("#canvasOrder-daftarPesanan").on('click', '.btnOrder-batalPemesanan', function(){
        Swal.fire({
            title: 'Apa kamu yakin?',
            text: "Pesanan yang sudah batal, tidak dapat dikembalikan..!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#435ebe',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yaa, batal pesanan!',
            cancelButtonText: 'Kembali'
        }).then((result) => {
            if (result.isConfirmed) {
                let kode_pemesanan = $(this).val();
                batal_pemesanan_pelanggan(kode_pemesanan);
            }
        });
    });
    // pembayaran
    $("#input-bukti-pembayaran-pelanggan").on('change', function(){
        $("#image-bukti-pembayaran-pelanggan").remove();
        let reader = new FileReader();
        reader.onload = function(){
            let data_bukti = "<img src='"+reader.result+"' alt='' class='img-fluid rounded' id='image-bukti-pembayaran-pelanggan'>";
            $("#canvas-bukti-pembayaran-pelanggan").prepend(data_bukti);
        }
        reader.readAsDataURL(this.files[0]);
    });
    $("#btnPembayaran-pemesananPelanggan").click(function(){
        if ($("#input-bukti-pembayaran-pelanggan")[0].files[0] == undefined) {
            $("#input-bukti-pembayaran-pelanggan").addClass("is-invalid");
            $("#invalid-input-bukti-pembayaran-pelanggan").text("Bukti pembayaran tidak boleh kosong!");
            return;
        }
        let form_pembayaran = new FormData();
        form_pembayaran.append("kode_transaksi", $(this).val());
        form_pembayaran.append("bukti_pembayaran", $("#input-bukti-pembayaran-pelanggan")[0].files[0]);
        pembayaran_pemesanan_pelanggan(form_pembayaran);
    });
    // pengiriman
    $("#btnConfirmasi-pesananSelesai").click(function(){
        Swal.fire({
            title: 'Pesanan diterima?',
            text: "Pesanan yang terkonfirmasi diterima, tidak dapat dikembalikan..!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#435ebe',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yaa, Pesanan diterima!',
            cancelButtonText: 'Kembali'
        }).then((result) => {
            if (result.isConfirmed) {
                let kode_pemesanan = $(this).val();
                $("#inputUlasan-kodePemesanan").val(kode_pemesanan);
                $("#modalUlasanPesanan").modal('show');
            }
        });
    });
    $("#btnUlasan-simpanUlasanPelanggan").click(function(){
        let kode_pemesanan = $("#inputUlasan-kodePemesanan").val();
        let desain_pemesanan = $("#inputUlasan-ulasanPemesanan").val();
        selesai_pemesanan_pelanggan(kode_pemesanan, desain_pemesanan);
    });
    // login
    $("#inputCheck-showPassword").on('change', function(){
        if ($(this).is(":checked")){
            $("#input-password-pelanggan").attr('type', 'text');
        }else{
            $("#input-password-pelanggan").attr('type', 'password');
        }
    });
    // register
    $("#inputCheck-showPasswordRegister").on('change', function(){
        if ($(this).is(":checked")){
            $("#input-password-pelanggan").attr('type', 'text');
            $("#input-password-ulang-pelanggan").attr('type', 'text');
        }else{
            $("#input-password-pelanggan").attr('type', 'password');
            $("#input-password-ulang-pelanggan").attr('type', 'password');
        }
    });
    // verifikasi
    $("#canvasInput-verifikasiPelanggan").on('keyup', '.input-token', function(event){
        var key = (event.keyCode ? event.keyCode : event.which);
        if (key == '08') { //jika keyboar yang ditekan adalah backspase
            let nomor = ($('.input-token').index($(this)) + 1);
            console.log(nomor);
            if (nomor <= 6) {
                $("#token-"+(nomor - 1)).focus();
            }
        }
    });
    $("#canvasInput-verifikasiPelanggan").on('keyup', '.input-token', function(event){
        let nomor = ($('.input-token').index($(this)) + 1);
        var key = (event.keyCode ? event.keyCode : event.which);
        if (key != '08') {
            if (nomor != 6) {
                $("#token-"+(nomor + 1)).focus();
            }
        }
    });
    // beranda
    $("#buttonPlay-playVideoTutorial").click(function(){
        let data_video = "<video width='100%' height='100%' controls id='tampilVideo-videoSatu'>"+
                            "<source src='/front/dist/video/tutorial.mp4' type='video/mp4'>"+
                        "</video>";
        $("#canvasVideo-tampilVideo").append(data_video);
        $("#canvasVideo-backgroundBlack").fadeIn();
    });
    $("#buttonPlay-playVideo").click(function(){
        let data_video = "<video width='100%' height='100%' controls id='tampilVideo-videoSatu'>"+
                            "<source src='/front/dist/video/dokumentasi.mp4' type='video/mp4'>"+
                        "</video>";
        $("#canvasVideo-tampilVideo").append(data_video);
        $("#canvasVideo-backgroundBlack").fadeIn();
    });
    $("#btnClose-closeVideo").click(function(){
        $("#tampilVideo-videoSatu").remove();
        $("#canvasVideo-backgroundBlack").fadeOut();
    });
});