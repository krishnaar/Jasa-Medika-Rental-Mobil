<div class="modal" id="status_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Status @yield('title')</h4>
            </div>
            <form action="" id="status_url" method="POST">
                @method("PUT")
                @csrf
                <div class="modal-body">
                    <div class="status_content">
                        <div class="">
                          <select name="status" class="selectpicker" data-style="select-with-transition"  title="Pilih Status" required>
                            <option disabled> Pilih Status</option>
                            @if (Auth::user()->role->id == 1)
                                <option value="Disetujui">Disetujui </option>
                                <option value="Dikembalikan">Dikembalikan</option>
                            @else
                                <option value="Dikembalikan">Dikembalikan</option>
                            @endif
                          
                          </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="delete-btn">Submit</button>

                    {{-- <button type="button" class="btn btn-danger" id="delete-btn"><i class="fa fa-fw fa-trash"></i>Hapus</button> --}}
                    <button type="button" class="btn btn-default" onclick="$('#status_modal')[0].style.display='none';"
                        data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
