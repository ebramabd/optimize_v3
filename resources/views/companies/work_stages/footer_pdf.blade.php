
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="file://{{ public_path('design/admin/assets/css/pdf-footer.css') }}" rel="stylesheet" type="text/css" />


    {{--    <link rel="stylesheet" href="{{public_path('css/pdf-footer.css')}}">--}}
</head>
<body style="padding-top: 10px">
<table class="print-footer">
    <tbody>
    <tr>
        <td colspan="2" class="text-end padding-top padding-right">
            انا الموقع أدناه، أفوض الشركة بتنفيذ الخدمات المطلوبة اعله مؤكدا صحة البيانات المذكورة ،ومسؤولياتي والتزامي بالشروط والحكام المبنية في هذه التفاقية.
        </td>
    </tr>
    <tr>
        <td colspan="2" class="text-start padding-bottom padding-top padding-left">
            I hereby authorize the company to carry out requested job and with undertaking about correctness of above provided, information awareness
            of my responsibilities and unconditional acceptance of items and conditions of this agreement.
        </td>
    </tr>
    <tr>
        <td class="text-start padding-left">
            Customer Approval Or Check-In Person
        </td>
        <td class="text-end padding-right">
            موافقة العميل او من ينوب عنه
        </td>
    </tr>
    <tr>
        <td colspan="2" class="text-center">
            @isset($signature)
            <img src="{{ public_path('storage/' . $signature) }}" alt="Signature" class="signature-img">
            @endisset
        </td>
    </tr>
    <tr>
        <td colspan="2" class="warning-text">
            Company Is Not Responsible For The Loss Of Any Personal Items From The Car
        </td>
    </tr>
    <tr>
        <td colspan="2" class="warning-text">
            الشركة غير مسئولة عن فقدان أى أغراض شخصية داخل السيارة
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
