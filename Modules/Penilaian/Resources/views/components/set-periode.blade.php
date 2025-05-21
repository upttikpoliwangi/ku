<div class="p-4">
    <form method="POST" action="{{ url('/penilaian/periode/set') }}">
        @csrf
        <div class="d-flex align-content-center">
            <select name="periodetahun" id="periode-tahun" class="form-control mr-2">
                <option value="">-- Pilih Tahun --</option>
                @foreach ($periode->groupBy(function ($item) {
                    return \Carbon\Carbon::parse($item->start_date)->year;
                }) as $tahun => $group)
                    <option {{ isset($periodeAktif) && \Carbon\Carbon::parse($periodeAktif->start_date)->year == $tahun ? 'selected' : '' }} value="{{ $group->first()->id }}" data-tahun="{{ $tahun }}">{{ $tahun }}</option>
                @endforeach
            </select>
            @error('periodetahun')
                <div style="color: red;">{{ $message }}</div>
            @enderror
            <select name="periode_range" id="periode-range" class="form-control mr-2">
                <option value="">-- Pilih Periode --</option>
                @foreach ($periode as $p)
                    <option {{ $periodeAktif && $periodeAktif->id == $p->id ? 'selected' : '' }} data-tahun="{{ \Carbon\Carbon::parse($p->start_date)->year }}" value="{{ $p->id }}">{{ $p->start_date }} - {{ $p->end_date }}</option>
                @endforeach
            </select>

            <input name="tim_kerja_id" id="nama-unit" class="form-control mr-2" value="{{ $pegawai->timKerjaAnggota[0]->unit->nama }}" disabled>
            @error('tim_kerja_id')
                <div style="color: red;">{{ $message }}</div>
            @enderror
            <input type="text" disabled class="form-control mr-2" value="{{ $pegawai->timKerjaAnggota[0]->pivot->peran }} {{ $pegawai->timKerjaAnggota[0]->unit->nama }}">
            <button type="submit" class="btn btn-primary">Set</button>
        </div>
    </form>
</div>
