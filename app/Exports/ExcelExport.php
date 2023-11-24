<?php
namespace App\Exports;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\BeforeExport;
class ExcelExport implements FromCollection, WithMapping
{
    use RegistersEventListeners;

    /**
     * @return Product|\Closure|\Illuminate\Support\Collection|null
     */
    public function collection()
    {
        return Product::all(
//            'id',
            'name',
            'description',
            'content',
            'menu_id',
            'price',
            'price_sale',
            'active',
            'created_at',
            'updated_at',
            'thumb'
        );
    }

    /**
     * @param $row
     * @return array
     */
    public function map($row): array
    {
        return [
            $row->id,
            $row->name,
            $row->description,
            $row->content,
            $row->menu_id,
            $row->price,
            $row->price_sale,
            $row->active,
            $row->created_at,
            $row->updated_at,
            'http://127.0.0.1:8000' . $row->thumb, // Use the FullURL format to make it a clickable link
        ];
    }
}
