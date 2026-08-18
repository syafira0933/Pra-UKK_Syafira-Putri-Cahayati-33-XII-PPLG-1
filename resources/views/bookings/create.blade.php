<x-app-layout>
    <div class="py-10 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 animate-fade-in-up">

            {{-- Header Simpatik Tailor --}}
            <div class="flex items-center gap-4">
                <a href="{{ route('bookings.index') }}"
                   title="Kembali"
                   class="w-10 h-10 rounded-2xl bg-white border border-krem-dark/50 text-coklat hover:bg-coklat hover:text-white flex items-center justify-center transition-all duration-200 shadow-2xs hover:shadow-sm active:scale-95 group shrink-0">
                    <i class="fa-solid fa-arrow-left text-sm group-hover:-translate-x-0.5 transition-transform"></i>
                </a>
                <div>
                    <div class="flex items-center gap-2 text-xs font-medium text-emas tracking-wider uppercase mb-0.5">
                        <i class="fa-solid fa-scissors"></i> Simpatik Tailor
                    </div>
                    <h1 class="text-xl sm:text-2xl font-semibold text-gray-900 tracking-tight">Formulir Pesanan Busana Custom</h1>
                </div>
            </div>

            {{-- Alert Error --}}
            @if ($errors->any())
                <div class="p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl text-xs space-y-1 shadow-xs">
                    <div class="font-semibold text-red-800 flex items-center gap-2">
                        <i class="fa-solid fa-triangle-exclamation"></i> Mohon perbaiki data berikut:
                    </div>
                    <ul class="list-disc list-inside space-y-0.5 text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Container Form Order --}}
            <div class="bg-white p-6 sm:p-10 shadow-sm border border-krem-dark/40 rounded-3xl space-y-8 relative overflow-hidden">
                
                {{-- Decorative Tailor Badge --}}
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-krem/60 to-transparent rounded-bl-full pointer-events-none"></div>

                <form method="POST" action="{{ route('bookings.store') }}" enctype="multipart/form-data"
                      x-data="{
                          clothingType: '{{ old('clothing_type') }}',
                          serviceType: '{{ old('service_type') }}',
                          measurementMethod: '{{ old('measurement_method', 'datang_ke_tempat') }}',
                          quantity: {{ old('quantity', 1) }},
                          fileName: '',
                          imagePreview: null,
                          bookingDate: '{{ old('booking_date') }}',
                          dateInfo: '',
                          checkingDate: false,
                          handleFileChange(event) {
                              const file = event.target.files[0];
                              if (file) {
                                  this.fileName = file.name;
                                  const reader = new FileReader();
                                  reader.onload = (e) => { this.imagePreview = e.target.result; };
                                  reader.readAsDataURL(file);
                              } else {
                                  this.fileName = '';
                                  this.imagePreview = null;
                              }
                          },
                          async checkDateAvailability() {
                              if (!this.bookingDate) { this.dateInfo = ''; return; }
                              this.checkingDate = true;
                              try {
                                  const res = await fetch(`{{ route('bookings.checkDate') }}?date=${this.bookingDate}`);
                                  const data = await res.json();
                                  if (data.is_full) {
                                      this.dateInfo = `⚠️ Tanggal ini sudah PENUH (${data.count}/${data.max_quota} pesanan). Silakan pilih tanggal lain.`;
                                  } else if (data.count > 0) {
                                      this.dateInfo = `Tanggal ini tersisa ${data.max_quota - data.count} slot (${data.count}/${data.max_quota} pesanan aktif). Jam fitting akan dikonfirmasi admin.`;
                                  } else {
                                      this.dateInfo = `Tanggal tersedia untuk jadwal fitting.`;
                                  }
                              } catch (e) {
                                  this.dateInfo = '';
                              } finally {
                                  this.checkingDate = false;
                              }
                          }
                      }">
                    @csrf

                    {{-- Step 1: Spesifikasi Busana --}}
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 border-b border-krem-dark/20 pb-3">
                            <span class="w-6 h-6 rounded-full bg-coklat text-white text-xs font-semibold flex items-center justify-center shadow-2xs">1</span>
                            <h3 class="font-semibold text-gray-900 text-sm">Spesifikasi Jenis Busana</h3>
                        </div>

                        {{-- Selection Jenis Pakaian --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">
                                Kategori Busana <span class="text-red-500">*</span>
                            </label>

                            <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
                                @php
                                    $clothingOptions = [
                                        ['name' => 'Kebaya', 'icon' => 'fa-person-dress'],
                                        ['name' => 'Dress', 'icon' => 'fa-person-dress-burst'],
                                        ['name' => 'Jas', 'icon' => 'fa-user-tie'],
                                        ['name' => 'Kemeja', 'icon' => 'fa-shirt'],
                                        ['name' => 'Blouse', 'icon' => 'fa-vest-patches'],
                                        ['name' => 'Rok', 'icon' => 'fa-vest'],
                                        ['name' => 'Celana', 'icon' => 'fa-socks'],
                                        ['name' => 'Seragam', 'icon' => 'fa-user-nurse'],
                                        ['name' => 'Pakaian Anak', 'icon' => 'fa-child-reaching'],
                                        ['name' => 'Lainnya', 'icon' => 'fa-ellipsis'],
                                    ];
                                @endphp

                                @foreach ($clothingOptions as $item)
                                    <label class="relative flex flex-col items-center justify-center p-3 rounded-2xl border cursor-pointer transition-all duration-200 text-center select-none group"
                                           :class="clothingType === '{{ $item['name'] }}'
                                               ? 'border-emas bg-gradient-to-b from-krem/70 to-krem/30 text-coklat-dark font-semibold shadow-xs'
                                               : 'border-krem-dark/40 bg-white text-gray-600 hover:border-emas/50 hover:bg-krem-light/40'">
                                        <input type="radio" name="clothing_type" value="{{ $item['name'] }}" x-model="clothingType" class="hidden">
                                        <div class="w-8 h-8 rounded-xl flex items-center justify-center text-xs mb-1.5 transition-transform group-hover:scale-105"
                                             :class="clothingType === '{{ $item['name'] }}' ? 'bg-coklat text-white shadow-2xs' : 'bg-krem/70 text-coklat'">
                                            <i class="fa-solid {{ $item['icon'] }}"></i>
                                        </div>
                                        <span class="text-xs">{{ $item['name'] }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Input Tambahan jika Jenis Pakaian = Lainnya --}}
                        <div x-show="clothingType === 'Lainnya'" x-transition>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Sebutkan Jenis Busana Lainnya <span class="text-red-500">*</span></label>
                            <input type="text" name="other_clothing_type" value="{{ old('other_clothing_type') }}"
                                   placeholder="Contoh: Gamis Syar'i, Batik Custom, Outer, dll."
                                   class="w-full border-krem-dark/60 rounded-xl text-sm focus:border-coklat focus:ring-coklat bg-krem-light/30 p-3">
                        </div>

                        {{-- Selection Jenis Layanan --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">
                                Jenis Layanan Pengerjaan <span class="text-red-500">*</span>
                            </label>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5">
                                <label class="flex items-center gap-3.5 p-4 rounded-2xl border cursor-pointer transition-all select-none"
                                       :class="serviceType === 'Jahit Baru' ? 'border-emas bg-krem/60 text-coklat-dark font-semibold shadow-xs' : 'border-krem-dark/40 bg-white text-gray-600 hover:border-emas/50'">
                                    <input type="radio" name="service_type" value="Jahit Baru" x-model="serviceType" class="hidden">
                                    <div class="w-9 h-9 rounded-xl flex items-center justify-center text-xs shrink-0"
                                         :class="serviceType === 'Jahit Baru' ? 'bg-coklat text-white shadow-2xs' : 'bg-krem text-coklat'">
                                        <i class="fa-solid fa-scissors"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold">Jahit Kustom Baru</p>
                                        <p class="text-[11px] text-gray-400 font-normal mt-0.5">Pembuatan pakaian dari kain mentah</p>
                                    </div>
                                </label>

                                <label class="flex items-center gap-3.5 p-4 rounded-2xl border cursor-pointer transition-all select-none"
                                       :class="serviceType === 'Permak' ? 'border-emas bg-krem/60 text-coklat-dark font-semibold shadow-xs' : 'border-krem-dark/40 bg-white text-gray-600 hover:border-emas/50'">
                                    <input type="radio" name="service_type" value="Permak" x-model="serviceType" class="hidden">
                                    <div class="w-9 h-9 rounded-xl flex items-center justify-center text-xs shrink-0"
                                         :class="serviceType === 'Permak' ? 'bg-coklat text-white shadow-2xs' : 'bg-krem text-coklat'">
                                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold">Permak / Alterasi</p>
                                        <p class="text-[11px] text-gray-400 font-normal mt-0.5">Penyesuaian ukuran & perbaikan</p>
                                    </div>
                                </label>

                                <label class="flex items-center gap-3.5 p-4 rounded-2xl border cursor-pointer transition-all select-none"
                                       :class="serviceType === 'Lainnya' ? 'border-emas bg-krem/60 text-coklat-dark font-semibold shadow-xs' : 'border-krem-dark/40 bg-white text-gray-600 hover:border-emas/50'">
                                    <input type="radio" name="service_type" value="Lainnya" x-model="serviceType" class="hidden">
                                    <div class="w-9 h-9 rounded-xl flex items-center justify-center text-xs shrink-0"
                                         :class="serviceType === 'Lainnya' ? 'bg-coklat text-white shadow-2xs' : 'bg-krem text-coklat'">
                                        <i class="fa-solid fa-pen-ruler"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold">Lainnya</p>
                                        <p class="text-[11px] text-gray-400 font-normal mt-0.5">Konsultasi / payet / bordir</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        {{-- Input Tambahan jika Layanan = Lainnya --}}
                        <div x-show="serviceType === 'Lainnya'" x-transition>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Sebutkan Layanan Lainnya <span class="text-red-500">*</span></label>
                            <input type="text" name="other_service_type" value="{{ old('other_service_type') }}"
                                   placeholder="Contoh: Pasang Payet Mutiara, Bordir Kustom, dll."
                                   class="w-full border-krem-dark/60 rounded-xl text-sm focus:border-coklat focus:ring-coklat bg-krem-light/30 p-3">
                        </div>

                        {{-- Jumlah Pakaian --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                                Kuantitas / Jumlah Busana <span class="text-red-500">*</span>
                            </label>
                            <div class="flex items-center gap-3">
                                <div class="inline-flex items-center bg-krem-light border border-krem-dark/60 rounded-xl p-1">
                                    <button type="button" @click="quantity = Math.max(1, quantity - 1)"
                                            class="w-8 h-8 rounded-lg bg-white text-coklat font-semibold hover:bg-coklat hover:text-white transition-colors shadow-2xs flex items-center justify-center">
                                        <i class="fa-solid fa-minus text-xs"></i>
                                    </button>
                                    <input type="number" name="quantity" x-model.number="quantity" min="1"
                                           class="w-14 text-center border-0 bg-transparent font-semibold text-gray-900 text-sm focus:ring-0">
                                    <button type="button" @click="quantity = quantity + 1"
                                            class="w-8 h-8 rounded-lg bg-white text-coklat font-semibold hover:bg-coklat hover:text-white transition-colors shadow-2xs flex items-center justify-center">
                                        <i class="fa-solid fa-plus text-xs"></i>
                                    </button>
                                </div>
                                <span class="text-xs text-gray-400">Potong Busana</span>
                            </div>
                        </div>
                    </div>

                    {{-- Step 2: Fitting & Pengukuran --}}
                    <div class="space-y-5 pt-4">
                        <div class="flex items-center gap-3 border-b border-krem-dark/20 pb-3">
                            <span class="w-6 h-6 rounded-full bg-coklat text-white text-xs font-semibold flex items-center justify-center shadow-2xs">2</span>
                            <h3 class="font-semibold text-gray-900 text-sm">Fitting & Metode Pengukuran</h3>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="flex items-start gap-3.5 p-4 rounded-2xl border cursor-pointer transition-all select-none"
                                   :class="measurementMethod === 'datang_ke_tempat' ? 'border-emas bg-krem/60 text-coklat-dark font-semibold shadow-xs' : 'border-krem-dark/40 bg-white text-gray-600 hover:border-emas/50'">
                                <input type="radio" name="measurement_method" value="datang_ke_tempat" x-model="measurementMethod" class="hidden">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center text-sm shrink-0 mt-0.5"
                                     :class="measurementMethod === 'datang_ke_tempat' ? 'bg-coklat text-white shadow-2xs' : 'bg-krem text-coklat'">
                                    <i class="fa-solid fa-store"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold">Datang ke Simpatik Tailor</p>
                                    <p class="text-[11px] text-gray-400 font-normal mt-0.5">Fitting & ukur baju langsung di toko kami.</p>
                                </div>
                            </label>

                            <label class="flex items-start gap-3.5 p-4 rounded-2xl border cursor-pointer transition-all select-none"
                                   :class="measurementMethod === 'di_tempat_pelanggan' ? 'border-emas bg-krem/60 text-coklat-dark font-semibold shadow-xs' : 'border-krem-dark/40 bg-white text-gray-600 hover:border-emas/50'">
                                <input type="radio" name="measurement_method" value="di_tempat_pelanggan" x-model="measurementMethod" class="hidden">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center text-sm shrink-0 mt-0.5"
                                     :class="measurementMethod === 'di_tempat_pelanggan' ? 'bg-coklat text-white shadow-2xs' : 'bg-krem text-coklat'">
                                    <i class="fa-solid fa-house-user"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold">Home Service (Di Tempat Pelanggan)</p>
                                    <p class="text-[11px] text-gray-400 font-normal mt-0.5">Kunjungan tim penjahit ke lokasi Anda.</p>
                                </div>
                            </label>
                        </div>

                        {{-- Alert Home Service --}}
                        <div x-show="measurementMethod === 'di_tempat_pelanggan'" x-transition class="p-4 bg-amber-50/90 rounded-2xl border border-amber-200/80 text-xs text-amber-900 space-y-1">
                            <p class="font-semibold flex items-center gap-1.5"><i class="fa-solid fa-circle-info text-amber-600"></i> Syarat Layanan Kunjungan:</p>
                            <p class="text-amber-700">Khusus pemesanan minimal 15 pakaian. Biaya transportasi akan dikonfirmasi admin.</p>

                            <template x-if="parseInt(quantity) < 15">
                                <p class="mt-2 text-red-600 font-medium bg-red-50 p-2.5 rounded-xl border border-red-200">
                                    Jumlah pakaian saat ini (<span x-text="quantity"></span> Pcs) kurang dari 15.
                                </p>
                            </template>
                        </div>

                        <div x-show="measurementMethod === 'di_tempat_pelanggan'" x-transition>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Alamat Kunjungan Pengukuran <span class="text-red-500">*</span></label>
                            <textarea name="address" rows="3" placeholder="Masukkan alamat lengkap lokasi kunjungan..."
                                      class="w-full border-krem-dark/60 rounded-xl text-sm focus:border-coklat focus:ring-coklat bg-krem-light/30 p-3">{{ old('address') }}</textarea>
                        </div>
                    </div>

                    {{-- Step 3: Schedule & Model --}}
                    <div class="space-y-5 pt-4">
                        <div class="flex items-center gap-3 border-b border-krem-dark/20 pb-3">
                            <span class="w-6 h-6 rounded-full bg-coklat text-white text-xs font-semibold flex items-center justify-center shadow-2xs">3</span>
                            <h3 class="font-semibold text-gray-900 text-sm">Jadwal Fitting & Referensi Desain</h3>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1.5">Tanggal Pengukuran <span class="text-red-500">*</span></label>
                                <input type="date" name="booking_date" min="{{ date('Y-m-d') }}" x-model="bookingDate"
                                       @change="checkDateAvailability()"
                                       class="w-full border-krem-dark/60 rounded-xl text-sm focus:border-coklat focus:ring-coklat bg-krem-light/30 p-3">
                                <div x-show="dateInfo" x-transition class="mt-2 text-xs p-2.5 rounded-xl border bg-krem-light border-krem-dark/40 text-coklat-dark">
                                    <span x-text="dateInfo"></span>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1.5">Waktu Kedatangan <span class="text-red-500">*</span></label>
                                <input type="time" name="booking_time" value="{{ old('booking_time', '10:00') }}"
                                       class="w-full border-krem-dark/60 rounded-xl text-sm focus:border-coklat focus:ring-coklat bg-krem-light/30 p-3">
                            </div>
                        </div>

                        {{-- Upload Image --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Foto Referensi Model Desain (Opsional)</label>
                            <label class="flex flex-col items-center justify-center border-2 border-dashed border-krem-dark/60 rounded-2xl p-5 cursor-pointer hover:border-emas hover:bg-krem-light/50 transition-all text-center">
                                <input type="file" name="reference_image" accept=".jpg,.jpeg,.png" class="hidden"
                                       @change="handleFileChange($event)">

                                <template x-if="!imagePreview">
                                    <div class="space-y-1 text-gray-400">
                                        <i class="fa-solid fa-cloud-arrow-up text-xl text-coklat"></i>
                                        <p class="text-xs font-semibold text-gray-700">Unggah foto contoh model pakaian</p>
                                        <p class="text-[11px]">JPG, PNG (Maks 2 MB)</p>
                                    </div>
                                </template>

                                <template x-if="imagePreview">
                                    <div class="space-y-2">
                                        <img :src="imagePreview" class="h-36 object-contain rounded-xl border border-krem-dark shadow-xs mx-auto">
                                        <p class="text-xs text-coklat font-semibold" x-text="fileName"></p>
                                    </div>
                                </template>
                            </label>
                        </div>

                        {{-- Catatan --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Catatan Khusus Penjahit (Opsional)</label>
                            <textarea name="notes" rows="2" placeholder="Tuliskan keinginan khusus seputar bahan, furing, kerut, atau potong..."
                                      class="w-full border-krem-dark/60 rounded-xl text-sm focus:border-coklat focus:ring-coklat bg-krem-light/30 p-3">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="pt-4">
                        <button type="submit"
                                :disabled="measurementMethod === 'di_tempat_pelanggan' && parseInt(quantity) < 15"
                                :class="(measurementMethod === 'di_tempat_pelanggan' && parseInt(quantity) < 15) ? 'opacity-50 cursor-not-allowed bg-gray-300' : 'bg-gradient-to-r from-coklat-dark via-coklat to-coklat-light hover:shadow-md hover:scale-[1.01] active:scale-[0.99] text-white'"
                                class="w-full py-3.5 rounded-2xl font-semibold text-sm transition-all flex items-center justify-center gap-2 shadow-sm">
                            <i class="fa-solid fa-paper-plane"></i>
                            <span>Kirim Formulir Pemesanan</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>