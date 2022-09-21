$(function () {
    $('#searchForm input[name="searchCompany"]').change(function () {
        $('#searchForm').submit();
    })
    $('#searchForm select[name="sort"]').change(function () {
        $('input[name="category_id"]').val()
        // {{ $customerCategorie->id }}
        $('#searchForm').submit();
    })
})
