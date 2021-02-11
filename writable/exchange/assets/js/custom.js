(function ($) {
    "use strict";
    var crypto = {
        initialize: function () {
            this.chatPanel();
            this.dataTable();
            this.dtatableLink();
            this.bgImage();
            this.profile();
            this.scrollBar();
            this.clock();
            this.countrySelect();
            this.switcher();
            this.pageloader();
        },
        chatPanel: function () {
            $('.dismiss').on('click', function () {
                $('.chat-panel').removeClass('active');
            });
            $('.chat-list .chat-list_item').on('click', function () {
                $('.chat-panel').addClass('active');
                $('.collapse.in').toggleClass('in');
            });
        },
        dataTable: function () {
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $.fn.dataTable.tables({visible: true, api: true}).columns.adjust();
            });
            $('.data-table').DataTable({
                lengthChange: false,
                searching: false,
                paging: false,
                info: false,
                scrollY: '34vh',
                scrollCollapse: true
            });
        },
        dtatableLink: function () {
            //Dtatable Link
            $('.market-table').on('click', 'tbody tr', function () {
                window.location.href = $(this).data('href');
            });
        },
        bgImage: function () {
            //Background image
            $(".bg-img").css('backgroundImage', function () {
                var bg = ('url(' + $(this).data("image-src") + ')');
                return bg;
            });
        },

        fileBrowser: function () {
            //Custom input file
            // Variables
            var $customInputFile = $('.custom-input-file');
            // Methods
            function change($input, $this, $e) {
                var fileName,
                        $label = $input.next('label'),
                        labelVal = $label.html();

                if ($this && $this.files.length > 1) {
                    fileName = ($this.getAttribute('data-multiple-caption') || '').replace('{count}', $this.files.length);
                } else if ($e.target.value) {
                    fileName = $e.target.value.split('\\').pop();
                }

                if (fileName) {
                    $label.find('span').html(fileName);
                } else {
                    $label.html(labelVal);
                }
            }

            function focus($input) {
                $input.addClass('has-focus');
            }

            function blur($input) {
                $input.removeClass('has-focus');
            }


            // Events

            if ($customInputFile.length) {
                $customInputFile.each(function () {
                    var $input = $(this);

                    $input.on('change', function (e) {
                        var $this = this,
                                $e = e;

                        change($input, $this, $e);
                    });

                    // Firefox bug fix
                    $input.on('focus', function () {
                        focus($input);
                    })
                            .on('blur', function () {
                                blur($input);
                            });
                });
            }
        },

        profile: function () {
            //news details collapse
            $('.profile').each(function () {
                const ps = new PerfectScrollbar($(this)[0]);
            });
            $('.profile_overlay').on('click', function () {
                $('.profile').removeClass('active');
                $('.profile_overlay').removeClass('active');
            });
            $('.profile-collapse').on('click', function () {
                $('.profile').addClass('active');
                $('.profile_overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
            });
        },
        scrollBar: function () {
            $('.chat-list, .chat-body, .sell-order-table-wrap .dataTables_scrollBody, .buy-order-table-wrap .dataTables_scrollBody, .history-table-wrap .dataTables_scrollBody, .leader-board_content > ul, .market-table-wrap .dataTables_scrollBody, .news-content').each(function () {
                const ps = new PerfectScrollbar($(this)[0]);
            });
        },
        emojionearea: function () {
            //emojionearea
            $(".emojionearea").emojioneArea({
                pickerPosition: "top",
                tonesStyle: "radio"
            });
        },
        clock: function () {
            let clock = document.getElementById('clock');
            function getTime() {
                let date = new Date();
                let h = date.getHours();
                let m = date.getMinutes();
                let s = date.getSeconds();
                if (h < 10) {
                    h = '0' + h;
                }
                if (m < 10) {
                    m = '0' + m;
                }
                if (s < 10) {
                    s = '0' + s;
                }
                clock.innerHTML = (h + ':' + m + ':' + s);
            }
            getTime();
            let timeInterval = setInterval(getTime, 1000);
        },

        countrySelect: function () {
            function format(item) {
                if (!item.id) {
                    return item.text;
                }
                var countryUrl = "assets/plugins/flag-icon/flags/4x3/";
                var url = countryUrl;
                var img = $("<img>", {
                    class: "img-flag",
                    width: 18,
                    src: url + item.element.value.toLowerCase() + ".svg"
                });
                var span = $("<span>", {
                    text: " " + item.text
                });
                span.prepend(img);
                return span;
            }
            $(document).ready(function () {
                $("#countries").select2({
                    dropdownAutoWidth: true,
                    width: 'auto',
                    templateResult: function (item) {
                        return format(item, false);
                    }
                });
            });
        },
        tableProgress: function () {
            var updateProgress = function () {
                var trs = document.querySelectorAll('.table-body tr');
                for (var i = 0; i < trs.length; i++) {
                    var tr = trs[i];
                    var pr = tr.querySelector('.progres-s');
                }
            };
            setInterval(function () {
                updateProgress();
            }, );
        },
        switcher: function () {
            $('#switcher').on('click', function () {
                if ($('#switcher').attr('checked', true)) {
                    $('body').toggleClass('night-mode');
                } else if ($('#switcher').attr('checked', false)) {
                    $('body').toggleClass('night-mode');
                }
            });
        },
        flotChart: function () {
            $.plot('#flotChart1', [{
                    data: df3,
                    color: '#e1e5ed',
                    lines: {
                        lineWidth: 1
                    }
                }, {
                    data: df3,
                    color: '#837cc5',
                    lines: {
                        lineWidth: 1
                    }
                }, {
                    data: df3,
                    color: '#7367f0'
                }], {
                series: {
                    stack: 0,
                    shadowSize: 0,
                    lines: {
                        show: true,
                        lineWidth: 1.7,
                        fill: true,
                        fillColor: {colors: [{opacity: 0}, {opacity: 0.2}]}
                    }
                },
                grid: {
                    borderWidth: 0,
                    labelMargin: 5,
                    hoverable: true
                },
                yaxis: {
                    show: true,
                    color: 'rgba(72, 94, 144, .1)',
                    min: 0,
                    max: 160,
                    font: {
                        size: 10,
                        color: '#8392a5'
                    }
                },
                xaxis: {
                    show: true,
                    color: 'rgba(72, 94, 144, .1)',
                    ticks: [[0, '08:00'], [20, '09:00'], [40, '10:00'], [60, '11:00'], [80, '12:00'], [100, '13:00'], [120, '14:00'], [140, '15:00']],
                    font: {
                        size: 10,
                        family: 'Arial, sans-serif',
                        color: '#8392a5'
                    },
                    reserveSpace: false
                }
            });
        },
        pageloader: function () {
            setTimeout(function () {
                $('.page-loader-wrapper').fadeOut();
            }, 50);
        }
    };
    // Initialize
    $(document).ready(function () {
        crypto.initialize();
        $('[data-toggle="popover"]').popover();
    });
    $(window).on("load", function () {
        crypto.pageloader();
    });
}(jQuery));