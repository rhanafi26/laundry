        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Auto calculate total price in transaction form
        $(document).ready(function() {
            $('input[name="layanan[]"]').change(function() {
                let total = 0;
                $('input[name="layanan[]"]:checked').each(function() {
                    total += parseFloat($(this).data('harga'));
                });
                $('#harga').val('Rp ' + total.toLocaleString('id-ID'));
            });
        });

        // Confirm before delete
        $('.btn-delete').click(function() {
            return confirm('Apakah Anda yakin ingin menghapus data ini?');
        });
    </script>
</body>
</html>