<div class="modal" id="rent_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Konfirmasi Sewa</h4>
            </div>
            <form action="{{ route(Auth::user()->role->name.'.car.rent', $car->id) }}" method="POST">
            <div class="modal-body">
                @csrf
                <div class="form-group is-focused">
                    <label for="exampleEmail" class="bmd-label-floating"> Tanggal Peminjaman *</label>
                    <input type="date" class="form-control" name="from_date" id="from_date" required="true">
                </div>
                <div class="form-group is-focused">
                    <label for="exampleEmail" class="bmd-label-floating"> Tanggal Pengembalian *</label>
                    <input type="date" class="form-control" name="to_date" id="end_date" required="true">
                </div>
                <div class="form-group mt-3 is-focused">
                    <label for="exampleEmail" class="bmd-label-floating"> Total Biaya </label>
                    <input type="text" class="form-control" readonly  id="total_fee" >
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" name="Sewa" class="btn btn-success" ></input>
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            </form>
            </div>
        </div>
    </div>
</div>
