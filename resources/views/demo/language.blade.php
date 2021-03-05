<div class="float-right">
    <form action="" method="get" style="display: contents;">
        <div class="form-group row">
            <label for="Language" class="col-sm-5 col-form-label">Language</label>
            <div class="col-sm-7">
            <select class="form-control" name="lang" onchange="submit()">
                <option value="id" {{ $lang == 'id' ? 'selected' : '' }}>id</option>
                <option value="en" {{ $lang == 'en' ? 'selected' : '' }}>en</option>
            </select>
            </div>
        </div>
    </form>
</div>
