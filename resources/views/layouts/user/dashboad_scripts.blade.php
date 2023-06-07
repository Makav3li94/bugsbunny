<script>

    // ==============================================================
    // Date Picker
    // ==============================================================
    $(document).ready(function () {
        var selectedTab = $('.nav-tabs li a.active');


        if (selectedTab.length === 0) {
            $('#message').html('Please select tab');
            $('#default').addClass('show active')
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        tinymce.init({

            selector: 'textarea.tinymce-editor',

            language: "fa_IR",
            content_style: "", // if need to style
            placeholder: "",
            force_p_newlines: false,
            force_br_newlines: true,
            convert_newlines_to_brs: false,
            remove_linebreaks: true,

            plugins: [ // list of plugins to use
                "advlist  link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table directionality emoticons template paste"
            ],

            toolbar_mode: 'floating', // toolbar mode
            toolbar: /* toolbar order display */ "insertfile undo redo | styleselect | image csVideo | alignGroup | featuredFormat | link | bullist numlist | outdent indent | print preview fullpage",
            style_formats: [ /* style order display */
                {title: 'Head 1', block: 'h1'},
                {title: 'Head 2', block: 'h2'},
                {title: 'Head 3', block: 'h3'},
                {title: 'Head 4', block: 'h4'},
                {title: 'Head 5', block: 'h5'},
                {title: 'Head 6', block: 'h6'},
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
            ],

            content_css: '//www.tiny.cloud/css/codepen.min.css'

        });

        $(".datepicker-year").pDatepicker({
            "format": "YYYY/MM/DD",
            "viewMode": "year",
            "initialValue": false,
            "autoClose": true,
            "position": "auto",
            "onlyTimePicker": false,
            "onlySelectOnDate": true,
            "calendarType": "persian",
            "observer": true,
            "responsive": true
        });
        $(".datepicker-day").pDatepicker({
            "format": "YYYY/MM/DD",
            "viewMode": "day",
            "initialValue": false,
            "autoClose": true,
            "position": "auto",
            "onlyTimePicker": false,
            "onlySelectOnDate": true,
            "calendarType": "persian",
            "observer": true,
            "responsive": true,
            "minDate": new Date(),
        });
        $(".custom-select").select2({
            placeholder: "انتخاب کنید",
            minimumResultsForSearch: -1,
            language: {
                "noResults": function () {
                    return "نتیجه ای وجود نداشت.";
                }
            }
        });
        $(".custom-select-2").select2({
            placeholder: "انتخاب کنید",
            minimumResultsForSearch: 3,
            language: {
                "noResults": function () {
                    return "نتیجه ای وجود نداشت.";
                }
            }
        });
        $(".select2-multiple").select2({
            placeholder: "انتخاب کنید",
            language: {
                "noResults": function () {
                    return "نتیجه ای وجود نداشت.";
                }
            }
        });


        $('.dropify').dropify({
            messages: {}
        });



    });
    $(".activy").change(function () {
        if ($(this).is(":checked")) {
            $('[id^="is_active_answer"]').not(this).each(function () {
                $(this).bootstrapToggle('off');
            });
        }
    });

    function activaTab(tab) {
        $('.nav-tabs a[href="#' + tab + '"]').tab('show');
    }

    function getQuestions(section_id) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#questionIndexBody').html('');
        var id = section_id
        $.ajax({
            'url': "{{route('user.question.index')}}",
            'type': 'get',
            'dataType': 'json',
            data: {
                id: id,
            },
            beforeSend: function () {
                $('.preloader').fadeIn();
            },
            complete: function () {
                $('.preloader').fadeOut();
            },
            success: function (response) {
                var html

                $('#collapseQuestionIndex').modal('show');
                var stat;
                $.each(response.questions, function (key, question) {

                    if (question.is_active == 1) {
                        stat = '<span class="badge badge-info">فعال</span>'
                    } else {
                        stat = '<span class="badge badge-danger">غیرفعال</span>'
                    }
                    html += '<tr>\n' +
                        '  <td>' + question['question'] + '</td>\n' +
                        '  <td>' + question.unit + '</td>\n' +
                        '  <td>' + stat + '</td>\n' +
                        '  <td >\n' +
                        '  <button class="btn btn-success btn-sm edit-question" onclick="getQuestion(' + question.id + ')" id="' + question.id + '"><i class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش </button>\n' +
                        '  <button class="btn btn-danger btn-sm delete-question" onclick="deleteQuestion(' + question.id + ')" ><i class="d-inline-flex align-middle ti-close"></i></button>\n' +
                        '  </td>\n' +
                        '   </tr>';

                });
                $('#section_id_input').val(id)
                $('#questionIndexBody').html(html);

            }

        });
    }

    function getQuestion(id) {
        $('#collapseQuestionIndex').modal('hide');
        $('#collapseQuestionEdit').modal('show');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            'url': '/dashboard/question/' + id + '/edit',
            'type': 'get',
            'dataType': 'json',
            success: function (response) {
                if (!$.isEmptyObject(response)) {
                    $('#collapseQuestionForm input[name=question]').val(response.question);
                    // $('#collapseQuestionForm textarea[name=explanation]').val(response.question[0].explanation);
                    tinymce.get('info').setContent(response.explanation);
                    $('#collapseQuestionForm input[name=unit]').val(response.unit);
                    if (response.is_active == '1') {
                        $('#questin_is_active').bootstrapToggle('on')
                    } else {
                        $('#questin_is_active').prop('checked', false).change()
                    }
                    var data = response.answers;
                    $.each(data, function (key) {
                        $('#collapseQuestionForm #answer' + key + '').val(data[key].answer);
                        if (data[key].is_checked == '1') {
                            $('#collapseQuestionForm #is_active_answer' + key + '').bootstrapToggle('on');
                        } else {
                            $('#collapseQuestionForm #is_active_answer' + key + '').prop('checked', false).change()
                        }
                    });
                    $('#collapseQuestionForm').attr('action', '/dashboard/question/' + id,);
                }
            }
        });
    }

    function getTicket(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            'url': '/dashboard/ticket/' + id + '/edit',
            'type': 'get',
            'dataType': 'json',
            data: {
                id: id,
            },
            beforeSend: function () {
                $('.preloader').fadeIn();
            },
            complete: function () {
                $('.preloader').fadeOut();
            },
            success: function (response) {
                var html
                var chats = ''
                var ticket = response.ticket;
                var answer
                var status
                $('#collapseTicketEdit').modal('show');
                if (ticket.answer == '0') {
                    answer = '<span class="label label-info">پیام کاربر</span>'
                } else if (ticket.answer == '1') {
                    answer = '<span class="label label-info">در حال رسیدگی</span>'
                } else if (ticket.answer == '2') {
                    answer = '<span class="label label-info">پیام مدیر</span>'
                }
                if (ticket.status == '0') {
                    status = '<span class="label label-info">بسته</span>'
                } else {
                    status = '<span class="label label-warning">باز</span>'
                }

                html += '<tr>\n' +
                    '  <td>' + ticket.title + '</td>\n' +
                    '  <td>' + ticket.date + '</td>\n' +
                    '  <td>' + ticket.section + '</td>\n' +
                    '  <td>' + ticket.priority + '</td>\n' +
                    '  <td>' + status + '</td>\n' +
                    '  <td>' + answer + '</td>\n' +
                    '   </tr>';
                $('#chats').html('');
                $.each(ticket.faqs, function (key, faq) {
                    var text, name, user, link, pic
                    if (faq.question != null) {
                        text = faq.question
                        name = ticket.user_name
                        user = 'کاربر'
                        pic = '{{asset('images/user/'.$user->avatar)}}'
                        chats = '<ul class="list-unstyled p-0"><li class="media mb-3 mt-2 p-3" style="border:1px dotted #000">\n' +
                            '<img class="d-none d-sm-block ml-3" src="' + pic + '" width="60">\n' +
                            '<div class="media-body">\n' +
                            ' <h5 class="mt-0 mb-2 text-right"><strong>' + name + '</strong>\n' +
                            ' <span dir="ltr" class="float-left text-success" style="font-size: 10px">' + faq.created_at + '</span>\n' +
                            ' </h5>\n' +
                            ' <p class="mb-0 font-12 text-justify">' + text + '</p>\n' +
                            '</div></li>\n';
                    }
                    if (faq.reply != null) {
                        text = faq.reply
                        name = 'مدیریت'
                        user = 'مدیر'
                        pic = "{{asset('admin/assets/images/2.png')}}"

                        chats += '<ul class="list-unstyled p-0"><li class="media mb-3 mt-2 p-3" style="border:1px dotted #000">\n' +
                            '<img class="d-none d-sm-block ml-3" src="' + pic + '" width="60">\n' +
                            '<div class="media-body">\n' +
                            ' <h5 class="mt-0 mb-2 text-right"><strong>' + name + '</strong>\n' +
                            ' <span dir="ltr" class="float-left text-success" style="font-size: 10px">' + faq.created_at + '</span>\n' +
                            ' </h5>\n' +
                            ' <p class="mb-0 font-12 text-justify">' + text + '</p>\n' +
                            '</div></li>\n';
                    }

                    $('#chats').append(chats);
                    $('#collapseticket').attr('action', '/dashboard/faq/' + ticket.id);

                });
                // $('#section_id_input').val(id)
                $('#TicketBody').html(html);
                $('#chats').css('display', 'block');
                if (ticket.status == '1') {
                    $('#showForm').css('display', 'block');
                }
            }

        });
    }

    $('.close-ticket').on('click', function () {
        var id = $(this).attr('id');
        event.preventDefault();

        $('#form-' + id).submit()
    });

    function editSection(id) {
        $('#collapseSectionEdit').modal('show');
        $.ajax({
            'url': '/dashboard/challenge/' + id + '/edit',
            'type': 'get',
            'dataType': 'json',

            success: function (response) {
                if (!$.isEmptyObject(response.section)) {
                    $('#collapseSectionForm input[name=title]').val(response.section.title);
                    $('#collapseSectionForm input[name=expire_date]').val(response.section.expire_date);
                    $('#collapseSectionForm textarea[name=excerpt]').val(response.section.excerpt);
                    $('#collapseSectionForm select[name=category_id]').val(response.section.category_id).prop('selected', true).trigger('change.select2');
                    ;
                    tinymce.get('section_info').setContent(response.section.description);

                    $('#submitCollapseSection').attr('data-id', response.section.id);
                }
            }
        });
    }

    $('#submitCollapseSection').on('click', function () {
        var id = $('#submitCollapseSection').attr('data-id');
        var title = $('#collapseSectionForm input[name=title]').val();
        tinymce.triggerSave()

        var description = $('#section_info').val();
        var excerpt = $('#collapseSectionForm textarea[name=excerpt]').val();
        var expire_date = $('#collapseSectionForm input[name=expire_date]').val();
        var category_id = $('#collapseSectionForm select[name=category_id]').val();
        $.ajax({
            'url': '/dashboard/challenge/' + id,
            'type': 'patch',
            'dataType': 'json',
            data: {
                title: title,
                description: description,
                excerpt: excerpt,
                expire_date: expire_date,
                category_id: category_id,
            },
            success: function (response) {
                $('#toEditCollapseSection').text('');
                if (!$.isEmptyObject(response.collapseSectionError)) {
                    if (!$.isEmptyObject(response.collapseSectionError.title)) {
                        $('#toEditCollapseSectionTitle').text(response.collapseSectionError.title[0]);
                    }
                    if (!$.isEmptyObject(response.collapseSectionError.category_id)) {
                        $('#toEditCollapseSectionCat').text(response.collapseSectionError.category_id[0]);
                    }
                    if (!$.isEmptyObject(response.collapseSectionError.expire_date)) {
                        $('#toEditCollapseSectionExpire').text(response.collapseSectionError.expire_date[0]);
                    }
                    if (!$.isEmptyObject(response.collapseSectionError.description)) {
                        $('#toEditCollapseSectionDescription').text(response.collapseSectionError.description[0]);
                    }
                    if (!$.isEmptyObject(response.collapseSectionError.excerpt)) {
                        $('#toEditCollapseSectionExcerpt').text(response.collapseSectionError.excerpt[0]);
                    }

                } else {
                    $('#collapseSectionEdit').modal('hide');
                    $.toast({
                        heading: 'موفقیت!',
                        text: 'اطلاعات به روزرسانی شد',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500
                    });
                    if (response.section[4] == 0) {
                        var tr = $('#section-' + response.section[1]).parents('tr');
                    } else {
                        var tr = $('#thread-' + response.section[1]).parents('tr');
                    }

                    switch(response.section[5]) {
                        case 0:
                            stat = '<span class="badge badge-pill badge-info">معلق</span>'
                            break;
                        case 1:
                            stat = '<span class="badge badge-pill badge-warning">درحال بررسی</span>'
                            break;
                        case 2:
                            stat = '   <span class="badge badge-pill badge-success"> تایید شده</span>'
                            break;
                        case 3:
                            stat = '<span class="badge badge-pill badge-secondary"> رد شده</span>'
                            break;
                        case 4:
                            stat = '<span class="badge badge-pill badge-primary"> پایان یافته</span>'
                            break;
                        default:
                            stat = ''
                    }

                    tr.find('td:eq(0)').text(response.section[0]);
                    tr.find('td:eq(1)').text(response.section[2]);
                    tr.find('td:eq(2)').text(response.section[3]);
                    tr.find('td:eq(4)').html(stat);
                }
            }
        });
    });


    function editThread(id) {
        $('#collapseThreadEdit').modal('show');
        $.ajax({
            'url': '/dashboard/challenge/' + id + '/edit',
            'type': 'get',
            'dataType': 'json',

            success: function (response) {
                if (!$.isEmptyObject(response.section)) {
                    $('#collapseThreadForm input[name=title]').val(response.section.title);
                    $('#collapseThreadForm textarea[name=excerpt]').val(response.section.excerpt);
                    $('#collapseThreadForm select[name=category_id]').val(response.section.category_id).prop('selected', true).trigger('change.select2');
                    ;
                    tinymce.get('thread_info').setContent(response.section.description);

                    $('#submitCollapseThread').attr('data-id', response.section.id);
                }
            }
        });
    }

    $('#submitCollapseThread').on('click', function () {
        var id = $('#submitCollapseThread').attr('data-id');
        var title = $('#collapseThreadForm input[name=title]').val();
        tinymce.triggerSave()

        var description = $('#thread_info').val();
        var excerpt = $('#collapseThreadForm textarea[name=excerpt]').val();
        var category_id = $('#collapseThreadForm select[name=category_id]').val();
        $.ajax({
            'url': '/dashboard/challenge/' + id,
            'type': 'patch',
            'dataType': 'json',
            data: {
                title: title,
                description: description,
                excerpt: excerpt,
                category_id: category_id,
            },
            success: function (response) {
                $('#toEditCollapseSection').text('');
                if (!$.isEmptyObject(response.collapseSectionError)) {
                    if (!$.isEmptyObject(response.collapseSectionError.title)) {
                        $('#toEditCollapseThreadTitle').text(response.collapseSectionError.title[0]);
                    }
                    if (!$.isEmptyObject(response.collapseSectionError.category_id)) {
                        $('#toEditCollapseThreadCat').text(response.collapseSectionError.category_id[0]);
                    }

                    if (!$.isEmptyObject(response.collapseSectionError.description)) {
                        $('#toEditCollapseThreadDescription').text(response.collapseSectionError.description[0]);
                    }
                    if (!$.isEmptyObject(response.collapseSectionError.excerpt)) {
                        $('#toEditCollapseThreadExcerpt').text(response.collapseSectionError.excerpt[0]);
                    }

                } else {
                    $('#collapseThreadEdit').modal('hide');
                    $.toast({
                        heading: 'موفقیت!',
                        text: 'اطلاعات به روزرسانی شد',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500
                    });
                    if (response.section[4] == 0) {
                        var tr = $('#section-' + response.section[1]).parents('tr');
                    } else {
                        var tr = $('#thread-' + response.section[1]).parents('tr');
                    }
                    var stat

                    switch(response.section[5]) {
                        case 0:
                            stat = '<span class="badge badge-pill badge-info">معلق</span>'
                            break;
                        case 1:
                            stat = '<span class="badge badge-pill badge-warning">درحال بررسی</span>'
                            break;
                        case 2:
                            stat = '   <span class="badge badge-pill badge-success"> تایید شده</span>'
                            break;
                        case 3:
                            stat = '<span class="badge badge-pill badge-secondary"> رد شده</span>'
                            break;
                        case 4:
                            stat = '<span class="badge badge-pill badge-primary"> پایان یافته</span>'
                            break;
                        default:
                            stat = ''
                    }
                    tr.find('td:eq(0)').text(response.section[0]);
                    tr.find('td:eq(1)').text(response.section[2]);
                    tr.find('td:eq(2)').html(stat);
                    tr.find('td:eq(3)').text(response.section[3]);
                }
            }
        });
    });
    function deleteQuestion(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            'url': '/dashboard/question/' + id,
            'type': 'DELETE',
            'dataType': 'json',
            beforeSend: function () {
                $('.preloader').fadeIn();
            },
            complete: function () {
                $('.preloader').fadeOut();
            },
            success: function (response) {
                $('#toCreateGuarantee').text('');
                if (!$.isEmptyObject(response.questionError)) {
                    $.toast({
                        heading: 'خطا!',
                        text: 'ورودی های خود را بررسی کنید',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500
                    });

                } else if (response.question == 'deleted') {
                    $('.edit-question[id="' + id + '"]').parents('tr').fadeOut();
                    $.toast({
                        heading: 'موفقیت!',
                        text: 'اطلاعات حذف شد',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500
                    });

                }
            }
        });
    }

    @if(session()->get('for')=='section' )
    activaTab('add_chalenges');
    @endif
    @if(session()->get('for')=='thread' )
    activaTab('add_threads');
    @endif
    @if(session()->get('for')=='ticket' )
    activaTab('add_ticket');
    @endif
    @if(session()->get('crud')=='ticket_store' )
    activaTab('ticket');
    @endif

    @if(session()->get('crud')=='thread_store' )
    activaTab('threads');
    @endif
    @if(session()->get('crud')=='section_store' || session()->get('quest')=='true')
    @if(session()->get('section_id') !== null)
    activaTab('chalenges');
    getQuestions({{session()->get('section_id')}})
    @endif
    @endif
    @if(session()->get('for')=='question')
    $('#section_id_input').val({{session()->get('section_id')}})

    getQuestions({{session()->get('section_id')}})
    @endif
    $('.sort-table').DataTable({
        dom: 'tlip',
        pageLength: 5,
        autoWidth: false, // This parameter must be set to false
        order: [[ 0, "asc" ]],
        language: {
            "search": "جستجو",
            "lengthMenu": "نمایش _MENU_ رکورد در صفحه",
            "zeroRecords": "موردی یافت نشد.",
            "info": "نمایش صفحات _PAGE_ از _PAGES_",
            "infoEmpty": "هیچ رکوردی موجود نیست",
            "infoFiltered": "(فیتر شده از _MAX_ پرونده)",
            "paginate": {
                "first": "اولین",
                "last": "آخرین",
                "next": "بعدی",
                "previous": "قبلی",
            }
        }
    });
</script>
