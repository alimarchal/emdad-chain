<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Test</title>
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/flatly/bootstrap.min.css">--}}
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.0.45/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{url('combo_tree_two/style.css')}}">
</head>
<body>
<div class="row">

        <input type="text" id="justAnInputBox1" name="list" placeholder="Select" autocomplete="off"/>




</div>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{url('combo_tree_two/comboTreePlugin.js')}}" type="text/javascript"></script>


{{--

 {
            id: 1,
            title: '1-Four Wheels',
            subs: [
                {
                    id: 10,
                    title: '10-Car'
                }, {
                    id: 11,
                    title: '11-Truck',
                    subs: [
                        {
                            id: 40,
                            title: '40-Car'
                        }]
                }, {
                    id: 12,
                    title: '12-Transporter'
                }, {
                    id: 13,
                    title: '13-Dozer'
                }
            ]
        }, {
            id: 2,
            title: '2-Two Wheels',
            subs: [
                {
                    id: 20,
                    title: '20-Cycle'
                }, {
                    id: 21,
                    title: '21-Motorbike'
                }, {
                    id: 22,
                    title: '22-Scooter'
                }
            ]
        }, {
            id: 2,
            title: '2-Van'
        }, {
            id: 3,
            title: '3-Bus'
        }


--}}

<script type="text/javascript">


    var SampleJSONData2 = [
            @include('test.get_category', ['categories' => $parentCategories])
    ];


    var comboTree1, comboTree2;

    jQuery(document).ready(function ($) {

        comboTree3 = $('#justAnInputBox1').comboTree({
            source: SampleJSONData2,
            isMultiple: true,
            cascadeSelect: true,
            collapse: true
        });

        comboTree3.setSource(SampleJSONData2);


    });


</script>
</body>
</html>
