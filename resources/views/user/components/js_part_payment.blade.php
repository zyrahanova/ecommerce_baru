<script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>

<script>
    document.getElementById('confirm-purchase').addEventListener('click', function () {
        this.disabled = true;
        document.getElementById('loader').classList.remove('hidden'); 

        const productId = {{ $product->id }};
        const quantity = {{ $quantity }};
        const courier = document.getElementById('courier').value;
        const shippingCost = document.getElementById('shipping-cost').innerText.replace('Rp ', '').replace('.', '');
        
        fetch('{{ route('payment.process') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity,
                shipping_cost: shippingCost,
                courier: courier
            })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('loader').classList.add('hidden'); 

            if (data.status === 'success') {
                snap.pay(data.snap_token, {
                  onSuccess: function(result) {
                        Swal.fire({
                            title: 'Pembayaran Berhasil!',
                            text: 'Terima kasih telah melakukan pembayaran.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = '/';  
                        });
                    },
                    onPending: function(result) {
                        alert('Waiting for your payment!');
                    },
                    onError: function(result) {
                        alert('Payment failed: ' + result.status_message);
                    }
                });
            } else {
                alert('Failed to initiate payment');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('loader').classList.add('hidden'); 
            alert('Something went wrong. Please try again.');
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        fetch('https://zyraproject.web.id/api/provinces')
            .then(response => response.json())
            .then(result => {
                const provinces = result.rajaongkir.results;
                const provinceSelect = document.getElementById('province_destination');
                let options = '<option value="">Pilih Provinsi Tujuan</option>';
                provinces.forEach(province => {
                    options += `<option value="${province.province_id}">${province.province}</option>`;
                });
                provinceSelect.innerHTML = options;
            })
            .catch(error => console.error('Provinces API Error:', error));

        document.getElementById('province_destination').addEventListener('change', function () {
            const provinceId = this.value;
            fetch(`https://zyraproject.web.id/api/cities/${provinceId}`)
                .then(response => response.json())
                .then(result => {
                    const cities = result.rajaongkir.results;
                    const citySelect = document.getElementById('city_destination');
                    let options = '<option value="">Pilih Kota Tujuan</option>';
                    cities.forEach(city => {
                        options += `<option value="${city.city_id}">${city.type} ${city.city_name}</option>`;
                    });
                    citySelect.removeAttribute('disabled');
                    citySelect.innerHTML = options;
                })
                .catch(error => console.error('Cities API Error:', error));
        });

        document.getElementById('calculate-shipping').addEventListener('click', function () {
            const destination = document.getElementById('city_destination').value;
            const courier = document.getElementById('courier').value;
            const weight = {{ $quantity * 1000 }}; 

            if (!destination || !courier) {
                alert('Mohon lengkapi semua pilihan!');
                return;
            }

            document.getElementById('loader').classList.remove('hidden'); 

            fetch('https://zyraproject.web.id/api/cost', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({
                    origin: 40, 
                    destination: destination,
                    weight: weight,
                    courier: courier
                })
            })
            .then(response => response.json())
            .then(result => {
                document.getElementById('loader').classList.add('hidden'); 
                const costs = result.rajaongkir.results[0]?.costs || [];
                if (costs.length > 0) {
                    const cost = costs[0].cost[0].value;
                    document.getElementById('shipping-cost').textContent = `Rp ${cost.toLocaleString('id-ID')}`;
                    document.getElementById('shipping-cost-input').value = cost;
                    const total = {{ $product->price * $quantity }} + cost;
                    document.getElementById('total-price').textContent = `Rp ${total.toLocaleString('id-ID')}`;
                    document.getElementById('confirm-purchase').disabled = false;
                } else {
                    alert('Ongkir tidak ditemukan');
                }
            })
            .catch(error => {
                console.error('Shipping calculation error:', error);
                document.getElementById('loader').classList.add('hidden');  
                alert('Terjadi kesalahan dalam perhitungan ongkir');
            });
        });
    });
</script>