const tindakanData = <?php echo json_encode($tindakan_data); ?>;

    function updateHarga() {
        const tindakanInput = document.getElementById('transactionNumber');
        const tindakan = tindakanInput.value;
        const harga = tindakanData[tindakan] || '';

        // Cari elemen <option> yang sesuai dengan tindakan yang dipilih
        const option = Array.from(tindakanInput.list.options).find(opt => opt.value === tindakan);
        const jm = option ? option.getAttribute('type-jm') : '';

        document.getElementById('harga_tindakan').value = harga;
        document.getElementById('nama_tindakan').value = tindakan;
        document.getElementById('jm').value = jm;
        document.getElementById('total_jasa_medis').value = 0;
        document.getElementById('grand_total').value = 0;
        document.getElementById('jumlah_total').value = 0;
        document.getElementById('catatan').value = '';
        document.getElementById('dp').value = 0;
        document.getElementById('modal').value = 0;
        document.getElementById('diskon_lyt').value = 0;
        document.getElementById('diskon_jm').value = 0;
        document.getElementById('harga_manual').value = 0;
        document.getElementById('banyak_tindakan').value = 0;


        if (harga === 0 || harga === '0') {
            alert('Masukkan harga secara manual');
            document.getElementById('harga_manual').focus();
        }
        updateJumlahTotal();
        updateGrandTotal();
    }


    document.getElementById('harga_manual').addEventListener('input', updateJumlahTotal);
    document.getElementById('banyak_tindakan').addEventListener('input', updateJumlahTotal);
    document.getElementById('dp').addEventListener('input', updateJumlahTotal);
    document.getElementById('diskon_lyt').addEventListener('input', updateJumlahTotal);
    document.getElementById('diskon_jm').addEventListener('input', updateJumlahTotal);
    document.getElementById('modal').addEventListener('input', updateJumlahTotal);



    function updateJumlahTotal() {
        const hargaManual = parseFloat(document.getElementById('harga_manual').value) || 0;
        const banyakTindakan = parseInt(document.getElementById('banyak_tindakan').value) || 0;
        const hargaTindakan = parseFloat(document.getElementById('harga_tindakan').value) || 0;
        const dp = parseFloat(document.getElementById('dp').value) || 0;
        const diskonLyt = parseFloat(document.getElementById('diskon_lyt').value) || 0;
        const modal = parseFloat(document.getElementById('modal').value) || 0;
        const jasaMedis = parseFloat(document.getElementById('jm').value) || 0;
        const sisaDp = parseFloat(document.getElementById('sisa_dp').value) || 0;
        const sisaJm = parseFloat(document.getElementById('sisa_jm').value) || 0;

        const jumlahTotal = hargaManual * banyakTindakan;
        const grandTotal = hargaTindakan + jumlahTotal;
        const diskonAmount = (diskonLyt / 100) * grandTotal;
        const totalAfterDiscount = grandTotal - diskonAmount;
        const totalDP = dp > 0 ? dp : totalAfterDiscount;
        document.getElementById('jumlah_total').value = jumlahTotal;
        document.getElementById('grand_total').value = totalDP;

        if (dp > 0) {
            document.getElementById('catatan').value = 'Sisa Pembayaran Tindakan Rp. ' + (totalAfterDiscount - dp);
        } else {
            document.getElementById('catatan').value = '';
        }

        let totalJasaMedis;
        const effectiveTotal = dp > 0 ? dp : grandTotal; // Use grandTotal before discount for jasa medis

        if (jasaMedis == 0) {
            totalJasaMedis = effectiveTotal * 0.5;
        } else if (jasaMedis == 1) {
            totalJasaMedis = effectiveTotal;
        } else if (jasaMedis == 2) {
            totalJasaMedis = 20000 * (1 + banyakTindakan);
        } else if (jasaMedis == 3) {
            totalJasaMedis = effectiveTotal * 0.65;
        } else if (jasaMedis == 4) {
            totalJasaMedis = (effectiveTotal - modal) * 0.5;
        }

        document.getElementById('total_jasa_medis').value = totalJasaMedis;
        const grandTotalValue = parseFloat(document.getElementById('grand_total').value) || 0;
        const diskonJm = parseFloat(document.getElementById('diskon_jm').value) || 0;

        // Perhitungan diskon JM
        const diskonJmAmount = ((diskonJm / 100) * 2) * totalJasaMedis;
        const totalJasaMedisAfterDiskon = Math.round(totalJasaMedis - diskonJmAmount);
        document.getElementById('total_jasa_medis').value = totalJasaMedisAfterDiskon;

        // Perhitungan grand total setelah diskon JM
        const grandTotalAfterDiskonJm = grandTotalValue - diskonJmAmount;
        document.getElementById('grand_total').value = grandTotalAfterDiskonJm;

    }