function jsonAjax(url, types, param, datat, callback) {
    $.ajax({
        type: types,
        url: url,
        data: param,
        dataType: datat,
        success: callback,
        error: function() {
            //jAlert("网络繁忙，请稍后再试...", "提示框",
           // function() {})
        }
    })
}
function sendAjax(url, types, param, datat, callback, beforeSend, complete) {
    $.ajax({
        type: types,
        url: url,
        data: param,
        dataType: datat,
        beforeSend: beforeSend,
        complete: complete,
        success: callback,
        error: function() {
            // jAlert("网络繁忙，请稍后再试...", "提示框",
            // function() {})
        }
    })
}
function setprint() {
    jsonAjax("./cg.setprint.html", "get", "", "html", cgOrber.GetsetPrint)
}
function IsPC() {
    flag = 0;
    var ua = navigator.userAgent.toLowerCase();
    return /iphone|ipad|ipod/.test(ua) ? flag = 1 : /android/.test(ua) && (flag = 2),
    flag
}
function isNull(data) {
    return "" != data && void 0 != data && null != data
}
function PageSetup_Null() {
    try {
        var RegWsh = new ActiveXObject("WScript.Shell");
        hkey_key1 = "header",
        hkey_key2 = "footer",
        RegWsh.RegWrite(hkey_root + hkey_path + hkey_key1, ""),
        RegWsh.RegWrite(hkey_root + hkey_path + hkey_key2, ""),
        HKEY_Key = "margin_top",
        RegWsh.RegWrite(hkey_root + hkey_path + HKEY_Key, "0"),
        HKEY_Key = "margin_bottom",
        RegWsh.RegWrite(hkey_root + hkey_path + HKEY_Key, "0"),
        HKEY_Key = "margin_left",
        RegWsh.RegWrite(hkey_root + hkey_path + HKEY_Key, "0"),
        HKEY_Key = "margin_right",
        RegWsh.RegWrite(hkey_root + hkey_path + HKEY_Key, "0")
    } catch(e) {}
}
function playmsg(c) {
    var sound = swfobject.getObjectById("sound");
    sound && (sound.SetVariable("f", c), sound.GotoFrame(1))
}
function newsinfo() {
    jsonAjax("appnews.php", "get", "action=news&jaction=1&time=" + (new Date).getTime(), "json", GetAppNews)
}
function GetAppNews(data) {
    var json = eval(data);
    $("#news").html(json.c),
    _systemTime = json.cg_time,
    _sellBegTime = json.cg_stattime,
    _sellEndTime = json.cg_endtime,
    _openstart = json.cg_start,
    chatcount = json.chatcount;
    var issueno = json.issueno - 0;
    if (chatcount > 0 ? ($("#cgchat_num").text(chatcount), $("#cgchat_num").removeClass("cgchat_emain_no"), $("#cgchat_num").addClass("cgchat_emain_yes"), playmsg("./admincg/images/chatimg/newinfo.mp3")) : ($("#cgchat_num").text(""), $("#cgchat_num").addClass("cgchat_emain_no"), $("#cgchat_num").removeClass("cgchat_emain_yes")), issueno > 0) {
        var oldissueno = LeftPintIframe.fraObj().find(".left_userinfo #issueno_now").text() - 0;
        issueno > oldissueno && oldissueno > 0 && (location.href = "./app.html")
    }
}
function __$time(id) {
    return document.getElementById(id)
}
function chTime(param) {
    return new Date(1e3 * param).toLocaleDateString()
}
function getThisYear(param) {
    var myDate = new Date(1e3 * param);
    return myDate.getFullYear() > 9 ? myDate.getFullYear() : "0" + myDate.getFullYear()
}
function getThisMonth(param) {
    var myDate = new Date(1e3 * param),
    month = myDate.getMonth() + 1;
    return month > 9 ? month: "0" + month
}
function getThisDate(param) {
    var myDate = new Date(1e3 * param);
    return myDate.getDate() > 9 ? myDate.getDate() : "0" + myDate.getDate()
}
function getThisHour(param) {
    var myDate = new Date(1e3 * param);
    return myDate.getHours() > 9 ? myDate.getHours() : "0" + myDate.getHours()
}
function getThisMinute(param) {
    var myDate = new Date(1e3 * param);
    return myDate.getMinutes() > 9 ? myDate.getMinutes() : "0" + myDate.getMinutes()
}
function getThisSecond(param) {
    var myDate = new Date(1e3 * param);
    return myDate.getSeconds() > 9 ? myDate.getSeconds() : "0" + myDate.getSeconds()
}
function sellBegAndEndTime() {
    var sellBegTime = __$time("sellBegTime").getAttribute("sellBegTime"),
    sellEndTime = __$time("sellEndTime").getAttribute("sellEndTime");
    __$time("sellBegTime").innerHTML = chTime(sellBegTime) + "&nbsp;&nbsp;" + getThisHour(sellBegTime) + "点" + getThisMinute(sellBegTime) + "分" + getThisSecond(sellBegTime) + "秒",
    __$time("sellEndTime").innerHTML = chTime(sellEndTime) + "&nbsp;&nbsp;" + getThisHour(sellEndTime) + "点" + getThisMinute(sellEndTime) + "分" + getThisSecond(sellEndTime) + "秒"
}
function startTime(stars) {
    setInterval("activeTime()", 1e3)
}
function activeTime() {
    _sellBegTime = Math.floor(_sellBegTime) > 0 ? _sellBegTime: 0,
    _sellEndTime = Math.floor(_sellEndTime) > 0 ? _sellEndTime: 0,
    _systemTime = Math.floor(_systemTime) > 0 ? _systemTime: 0;
    var openclosestr = 1 == _openstart ? "离停盘": "离开盘";
    if (_systemTime - _sellBegTime < 0) return __$time("timeTag").innerHTML = "<strong>已封盘，尚未开盘!</strong>",
    !1;
    var restTime1 = _sellEndTime - _systemTime;
    if (_systemTime++, __$time("timeTag")) if (0 != _systemTime && restTime1 > 0) {
        var restTime = restTime1 / 3600,
        restHour = restTime % 24,
        restDay = restTime / 24,
        restMin = restTime1 % 3600 / 60,
        restSec = restTime1 % 3600 % 60;
        __$time("timeTag").innerHTML = openclosestr + "时间：" + (Math.floor(restDay) > 0 ? Math.floor(restDay) + "天": "") + (Math.floor(restHour) > 0 ? Math.floor(restHour) + "小时": "") + (Math.floor(restMin) > 0 ? Math.floor(restMin) + "分": "") + Math.floor(restSec) + "秒",
        restTime1 < 0 && (__$time("timeTag").innerHTML = "<strong>已封盘，尚未开盘!</strong>")
    } else 0 == restTime1 ? "function" == typeof newsinfo && newsinfo() : __$time("timeTag").innerHTML = "<strong>已封盘，尚未开盘!</strong>"
}
function $ss(id) {
    return document.getElementById(id)
}
function limitrepeat(t) {
    n = t.value,
    num = n.length;
    var y_n = n.slice(0, num - 1),
    g_n = n.slice(num - 1, num);
    y_n.indexOf(g_n) != -1 && (t.value = y_n)
}
function $_t(root, tag, id) {
    for (var ar = root.getElementsByTagName(tag), i = 0; i < ar.length; i++) if (ar[i].id == id) return ar[i];
    return null
}
function _(root) {
    var ids = arguments,
    i0 = 0;
    "string" == typeof root ? root = document: i0 = 1;
    for (var i = i0; i < ids.length; i++) {
        for (var s = root.getElementsByTagName("*"), has = !1, j = 0; j < s.length; j++) if (s[j].id == ids[i]) {
            root = s[j],
            has = !0;
            break
        }
        if (!has) return null
    }
    return root
}
function $dele(o, fn, rv) {
    var r = function() {
        for (var s = arguments.callee,
        args = [], i = 0; i < s.length; i++) args[i] = s[i];
        var argStr = args.join(",");
        argStr.length > 0 && (argStr = "," + argStr);
        var callStr = "s.thiz[s.fn](" + argStr + ")",
        v = eval(callStr);
        return null != s.rv ? s.rv: v
    };
    return r.thiz = o,
    r.fn = fn,
    r.rv = rv,
    r
}
function $ge(e) {
    return null != e ? e: $IE ? window.event: e
}
function $gte(e, ev) {
    return e.getElementById || (e = e.ownerDocument),
    $IE ? null != ev ? ev: e.parentWindow.event: ev
}
function $addEL(n, e, l, b) {
    if ($IE) {
        if (null == n["$__listener_" + e]) {
            var lst = function(e) {
                var f = arguments.callee,
                ar = f.fList;
                e = $ge(e);
                for (var i = 0; i < ar.length; i++) ar[i](e)
            };
            lst.fList = [],
            n["$__listener_" + e] = lst,
            n["on" + e] = n["$__listener_" + e]
        }
        var fList = n["$__listener_" + e].fList;
        fList[fList.length] = l
    } else n.addEventListener(e, l, b)
}
function $cancelEvent(e) {
    $IE ? (e.returnValue = !1, e.cancelBubble = !0) : e.preventDefault()
}
function $cpAttr(o, p) {
    for (var i in p) {
        var s = p[i];
        o[i] = s
    }
    return o
}
function $getValue(v, d) {
    return null == v ? d: v
}
function PopUp(id, config) {
    this.id = id;
    var c = this.config = config;
    c.width = $gv(c.width, 300),
    c.height = $gv(c.height, 200),
    c.bottom = $gv(c.bottom, 0),
    c.right = $gv(c.right, 20),
    c.display = $gv(c.display, !0),
    c.contentUrl = $gv(c.contentUrl, ""),
    c.motionFunc = $gv(c.motionFunc, $motion.smooth),
    c.position = {
        x: 0,
        y: 0
    };
    var t = c.time;
    t.slideIn = $gv(t.slideIn, 10),
    t.hold = $gv(t.hold, 10),
    t.slideOut = $gv(t.slideOut, 10),
    t.slideIn *= 1e3,
    t.hold *= 1e3,
    t.slideOut *= 1e3,
    this.container = document.body,
    this.popup = null,
    this.content = null,
    this.switchButton = null,
    this.moveTargetPosition = 0,
    this.startMoveTime = null,
    this.startPosition = null,
    this.status = PopUp.STOP,
    this.intervalHandle = null,
    this.mm = "max",
    this.imgMin = window_img + "min.gif",
    this.imgMax = window_img + "max.gif"
}
function readCookie(name) {
    var cookieValue = "",
    search = name + "=";
    return document.cookie.length > 0 && (offset = document.cookie.indexOf(search), offset != -1 && (offset += search.length, end = document.cookie.indexOf(";", offset), end == -1 && (end = document.cookie.length), cookieValue = unescape(document.cookie.substring(offset, end)))),
    cookieValue
}
function writeCookie(name, value, hours) {
    var expire = "";
    null != hours && (expire = new Date((new Date).getTime() + 36e5 * hours), expire = "; expires=" + expire.toGMTString()),
    document.cookie = name + "=" + escape(value) + expire + ";path=/"
}
function job_show_window(html) {
    for (var cfg = {
        width: 260,
        height: 190,
        bottom: 2,
        right: 19,
        display: !0,
        contentUrl: "./appnews.php?action=newswindow",
        time: {
            slideIn: 2,
            hold: 30,
            slideOut: 1
        }
    },
    displayTimeList = ["7+7"], cookieName = "sina_blog_popup_next_display_time", hours = {},
    i = 0; i < displayTimeList.length; i++) {
        for (var o = displayTimeList[i], ar = o.split("+"), t = parseInt(ar[0]), m = 0; m < ar.length - 1; m++) ar[m] = ar[m + 1];
        hours[t] = !0;
        for (var j = 0; j < ar.length; j++) hours[t + parseInt(ar[j])] = !0
    }
    displayTimeList = [];
    for (var i in hours) {
        var s = parseInt(i);
        isNaN(s) || (displayTimeList[displayTimeList.length] = s)
    }
    displayTimeList = displayTimeList.sort();
    var pp = new PopUp("xp", cfg);
    window.__popup = pp,
    pp.create();
    var i, i;
    readCookie(cookieName);
    pp.show(),
    $(".BR_conts").html(html),
    html = ""
} !
function($, window) {
    $.alerts = {
        verticalOffset: -75,
        horizontalOffset: 0,
        repositionOnResize: !0,
        overlayOpacity: .5,
        overlayColor: "#e2e2e2",
        draggable: !0,
        okButton: "&nbsp;&nbsp;确定&nbsp;&nbsp;",
        cancelButton: "&nbsp;&nbsp;取消&nbsp;&nbsp;",
        dialogClass: null,
        ProgressBar: function(message, title, callback) {
            null == title && (title = "ProgressBar"),
            $.alerts._show(title, message, null, "ProgressBar",
            function(result) {
                callback && callback(result)
            })
        },
        alertPrint: function(message, title, callback) {
            null == title && (title = "AlertPrint"),
            $.alerts._show(title, message, null, "alertPrint",
            function(result) {
                callback && callback(result)
            })
        },
        alert: function(message, title, callback) {
            null == title && (title = "Alert"),
            $.alerts._show(title, message, null, "alert",
            function(result) {
                callback && callback(result)
            })
        },
        confirm: function(message, title, callback) {
            null == title && (title = "Confirm"),
            $.alerts._show(title, message, null, "confirm",
            function(result) {
                callback && callback(result)
            })
        },
        prompt: function(message, value, title, callback) {
            null == title && (title = "Prompt"),
            $.alerts._show(title, message, value, "prompt",
            function(result) {
                callback && callback(result)
            })
        },
        _show: function(title, msg, value, type, callback) {
            $.alerts._hide(),
            $.alerts._overlay("show"),
            "alertPrint" == type ? $("body").append('<div id="popup_container"><div id="popup_container_print"><h1 id="popup_close">X</h1><h1 id="popup_title"></h1><div id="popup_content"><div id="popup_message"></div></div></div><div style="display:none" id="PrintPager" class="pagination"></div></div>') : $("body").append('<div id="popup_container"><h1 id="popup_title"></h1><div id="popup_content"><div id="popup_message"></div></div></div>'),
            $.alerts.dialogClass && $("#popup_container").addClass($.alerts.dialogClass);
            var pos = $.support.leadingWhitespace ? "fixed": "absolute";
            switch ($("#popup_container").css({
                position: pos,
                zIndex: 99999,
                padding: 0,
                margin: 0
            }), $("#popup_title").text(title), "alertPrint" == type ? $("#popup_container").addClass(type) : $("#popup_content").addClass(type), $("#popup_message").text(msg), $("#popup_message").html($("#popup_message").text().replace(/\n/g, "<br />")), $("#popup_container").css({
                minWidth: $("#popup_container").outerWidth() + 50,
                maxWidth: $("#popup_container").outerWidth() + 50
            }), $.alerts._reposition(), $.alerts._maintainPosition(!0), type) {
            case "ProgressBar":
                $("#popup_message").html('<span class="ProgressBar_t" ></span>'),
                $("#popup_message").after('<div style="height:80px"><div class="bi-bar" style="height:40px"><span class="ProgressBar_w_s"></span><div class="ProgressBar_w" style="width: 0%;"></div></div></div>'),
                callback(!0);
                break;
            case "alertPrint":
                $("#popup_message").after('<div id="popup_panel"><input class="btn" style="*width:80px" type="button" value="&nbsp;&nbsp;打印&nbsp;&nbsp;" id="popup_ok" />  <input class="btn" type="button" value="' + $.alerts.cancelButton + '" id="popup_cancel" /></div>'),
                $("#popup_ok").click(function() {
                    $("#popup_title, #popup_message").jqprint({
                        debug: !0,
                        operaSupport: !0
                    }),
                    callback(!0)
                }),
                $("#popup_cancel").click(function() {
                    $.alerts._hide()
                });
                break;
            case "alert":
                $("#popup_message").after('<div id="popup_panel"><input class="btn" style="*width:80px" type="button" value="' + $.alerts.okButton + '" id="popup_ok" /></div>'),
                $("#popup_ok").keypress(function(e) {
                    13 != e.keyCode && 27 != e.keyCode || $("#popup_ok").trigger("click")
                }),
                $("#popup_ok").unbind("click").click(function() {
                    $.alerts._hide(),
                    callback(!0)
                }),
                0 == IsPC() ? setTimeout('$("#popup_ok").focus();', 200) : setTimeout('$("#popup_ok").select();', 200);
                break;
            case "confirm":
                $("#popup_message").after('<div id="popup_panel"><input class="btn" type="button" value="' + $.alerts.okButton + '" id="popup_ok" /> <input class="btn" type="button" value="' + $.alerts.cancelButton + '" id="popup_cancel" /></div>'),
                $("#popup_ok").click(function() {
                    $.alerts._hide(),
                    callback && callback(!0)
                }),
                $("#popup_cancel").click(function() {
                    $.alerts._hide(),
                    callback && callback(!1)
                }),
                0 == IsPC() ? setTimeout('$("#popup_ok").focus();', 200) : setTimeout('$("#popup_ok").select();', 200),
                $("#popup_ok, #popup_cancel").keypress(function(e) {
                    13 == e.keyCode && $("#popup_ok").trigger("click"),
                    27 == e.keyCode && $("#popup_cancel").trigger("click")
                });
                break;
            case "prompt":
                $("#popup_message").append('<br /><input type="text" size="30" id="popup_prompt" />').after('<div id="popup_panel"><input class="btn" type="button" value="' + $.alerts.okButton + '" id="popup_ok" /> <input  class="btn" type="button" value="' + $.alerts.cancelButton + '" id="popup_cancel" /></div>'),
                $("#popup_prompt").width($("#popup_message").width()),
                $("#popup_ok").click(function() {
                    var val = $("#popup_prompt").val();
                    $.alerts._hide(),
                    callback && callback(val)
                }),
                $("#popup_cancel").click(function() {
                    $.alerts._hide(),
                    callback && callback(null)
                }),
                $("#popup_prompt, #popup_ok, #popup_cancel").keypress(function(e) {
                    13 == e.keyCode && $("#popup_ok").trigger("click"),
                    27 == e.keyCode && $("#popup_cancel").trigger("click")
                }),
                value && $("#popup_prompt").val(value),
                0 == IsPC() ? setTimeout('$("#popup_prompt").focus();', 200) : setTimeout('$("#popup_prompt").select();', 200)
            }
            if ($("#popup_close").unbind("click").click(function() {
                $.alerts._hide()
            }), $.alerts.draggable) try {
                $("#popup_container").draggable({
                    handle: $("#popup_title")
                }),
                $("#popup_title").css({
                    cursor: "move"
                })
            } catch(e) {}
        },
        _hide: function() {
            $("#popup_container").remove(),
            $.alerts._overlay("hide"),
            $.alerts._maintainPosition(!1)
        },
        _overlay: function(status) {
            switch (status) {
            case "show":
                $.alerts._overlay("hide"),
                $("body").append('<div id="popup_overlay"></div>'),
                $("#popup_overlay").css({
                    position: "absolute",
                    zIndex: 99998,
                    top: "0px",
                    left: "0px",
                    width: "100%",
                    height: $(document).height() - 10,
                    background: $.alerts.overlayColor,
                    opacity: $.alerts.overlayOpacity
                });
                break;
            case "hide":
                $("#popup_overlay").remove()
            }
        },
        _reposition: function() {
            var top = $(window).height() / 2 - $("#popup_container").outerHeight() / 2 + $.alerts.verticalOffset,
            left = $(window).width() / 2 - $("#popup_container").outerWidth() / 2 + $.alerts.horizontalOffset;
            top < 0 && (top = 0),
            left < 0 && (left = 0),
            $.support.leadingWhitespace || (top += $(window).scrollTop()),
            $("#popup_container").css({
                top: top + "px",
                left: left + "px"
            }),
            $("#popup_overlay").height($(document).height())
        },
        _maintainPosition: function(status) {
            if ($.alerts.repositionOnResize) switch (status) {
            case ! 0 : $(window).bind("resize",
                function() {
                    $.alerts._reposition()
                });
                break;
            case ! 1 : $(window).unbind("resize")
            }
        }
    },
    jProgressBar = function(message, title, callback) {
        $.alerts.ProgressBar(message, title, callback)
    },
    jAlertPrint = function(message, title, callback) {
        $.alerts.alertPrint(message, title, callback)
    },
    jAlert = function(message, title, callback) {
        $.alerts.alert(message, title, callback)
    },
    jConfirm = function(message, title, callback) {
        $.alerts.confirm(message, title, callback)
    },
    jPrompt = function(message, value, title, callback) {
        $.alerts.prompt(message, value, title, callback)
    }
} (jQuery, window);
var isIE6 = !$.support.opacity && !$.support.style && void 0 == window.XMLHttpRequest,
isIE7 = !$.support.opacity && !$.support.style && void 0 != window.window.XMLHttpRequest,
_openstart = 0,
_sellBegTime = 0,
_sellEndTime = 0,
LeftPintIframe = {
    name: function() {
        return $(window.document).contents().find("#leftprint")[0].contentWindow
    },
    refresh: function() {
        this.name().location.href = "./appprint.html"
    },
    fraObj: function() {
        return $(window.frames.leftprint.document)
    },
    orderprint: function() {
        return this.fraObj().find("#orderprint")
    }
},
getUserInfo = {
    credits_remaining: function() {
        var c = $(".main_left #credits_remaining").text() - 0;
        return c = Number(c.toFixed(2)) - 0,
        c = c > 0 ? c: 0
    },
    setInfo: function(cu, cr) {
        $("#credits_remaining").html(cr);
        var o = LeftPintIframe.fraObj();
        o.find("#credits_use").html(cu),
        o.find("#credits_remaining").html(cr)
    }
},
hkey_root,
hkey_path,
hkey_key;
hkey_root = "HKEY_CURRENT_USER",
hkey_path = "\\Software\\Microsoft\\Internet Explorer\\PageSetup\\",
function($) {
    jQuery.cachedScript = function(url, options) {
        return options = $.extend(options || {},
        {
            dataType: "script",
            cache: !0,
            url: url
        }),
        jQuery.ajax(options)
    },
    $.fn.checkBox = function(state) {
        this.each(function() {
            switch (state) {
            case "all":
                $(this).prop("checked", !0);
                break;
            case "none":
                $(this).prop("checked", !1);
                break;
            case "toggle":
                $(this).prop("checked", !this.checked)
            }
        })
    },
    $.fn.checkedValue = function() {
        var str = [],
        comm = "";
        return this.each(function() {
            $(this).prop("checked") && (str += comm + $(this).val(), comm = "|")
        }),
        str
    },
    $.fn.limitMoneyPoint = function() {
        $(this).keyup(function(event) {
            if (13 != (event.keyCode ? event.keyCode: event.which)) {
                var v = $(this).val();
                vv = v.replace(/[^0-9.]/g, ""),
                vv = vv.replace(" ", ""),
                $(this).val(vv)
            }
        }).bind("paste",
        function() {
            $(this).val($(this).val().replace(/[^0-9.]/g, ""))
        })
    },
    $.fn.limitMoneyX = function() {
        $(this).keyup(function() {
            var v = $(this).val();
            vv = v.replace("*", "X"),
            vv = vv.replace("+", "X"),
            vv = vv.replace(" ", ""),
            vv = vv.replace(/[^0-9.xX]/g, ""),
            $(this).val(vv),
            $(this).focus()
        }).bind("paste",
        function() {
            return $(this).focus(),
            !1
        }).css("ime-mode", "disabled")
    },
    $.fn.KdlimitMoneyX = function() {
        $(this).keyup(function() {
            var v = $(this).val();
            vv = v.replace("*", "X"),
            vv = vv.replace("+", "X"),
            vv = vv.replace(" ", ""),
            vv = vv.replace(/[^0-9]/g, "X"),
            $(this).val(vv),
            $(this).focus()
        })
    },
    $.fn.checkedDetailTuima = function() {
        var num = 0,
        allmoney = 0,
        allhuishui = 0,
        allyingkui = 0;
        this.each(function() {
            if ($(this).prop("checked")) {
                var money = $(this).parent().parent().find("td.money").html(),
                huishui = $(this).parent().parent().find("td:eq(7)").html(),
                yingkui = $(this).parent().parent().find("td:eq(8)").html();
                $(this).parent().parent().find("td:eq(9)").html("退码"),
                $(this).parent().parent().addClass("tuima"),
                $(this).parent().html("--"),
                $(this).remove(),
                num++,
                allmoney = cgCheckSend.FloatAdd(money, allmoney),
                allhuishui = cgCheckSend.FloatAdd(huishui, allhuishui),
                allyingkui = cgCheckSend.FloatAdd(yingkui, allyingkui),
                allhuishui = Number(allhuishui.toFixed(2)),
                allyingkui = Number(allyingkui.toFixed(2))
            }
        });
        var getnum = $("#detailheji").find("td:eq(1)").text();
        $("#detailheji").find("td:eq(1)").text(getnum - num);
        var getmoney = $("#detailheji").find("td:eq(3)").text();
        getmoney = cgCheckSend.FloatSubtr(getmoney, allmoney),
        getmoney = Number(getmoney.toFixed(2)),
        $("#detailheji").find("td:eq(3)").text(getmoney);
        var gethuishui = $("#detailheji").find("td:eq(6)").text();
        gethuishui = cgCheckSend.FloatSubtr(gethuishui, allhuishui),
        gethuishui = Number(gethuishui.toFixed(2)),
        $("#detailheji").find("td:eq(6)").text(gethuishui);
        var getyingkui = $("#detailheji").find("td:eq(7)").text();
        getyingkui = cgCheckSend.FloatSubtr(getyingkui, allyingkui),
        getyingkui = Number(getyingkui.toFixed(2)),
        $("#detailheji").find("td:eq(7)").text(getyingkui),
        LeftPintIframe.refresh()
    },
    $.fn.checkedEditCss = function() {
        var op = LeftPintIframe.orderprint();
        this.each(function() {
            if ($(this).prop("checked")) {
                if (op.find("#_z_bscount").text() > 500) LeftPintIframe.refresh(),
                jsonAjax("appindexajax.php", "get", "action=soonorder", "json", cgOrber.GetSoonOrder);
                else {
                    $("#checkboxALLID").attr("checked", !1);
                    var pobj = $(this).parent().parent();
                    pobj.addClass("tuima"),
                    pobj.removeClass("hotcss"),
                    pobj.find("td:eq(5)").html("退码");
                    var money = pobj.find("td.money").html(),
                    myorder = pobj.find("td:eq(1)").html();
                    $(this).parent().html("--"),
                    $(this).remove();
                    var id = $(this).val(),
                    get_bscount = op.find("#_bscount").text(),
                    get_allmoney = op.find("#_allmoney").text(),
                    get_z_bscount = op.find("#_z_bscount").text(),
                    get_z_allmoney = op.find("#_z_allmoney").text();
                    op.find("#orderlist tr#o_" + id).length > 0 && (get_bscount = cgCheckSend.FloatSubtr(get_bscount, 1), get_allmoney = cgCheckSend.FloatSubtr(get_allmoney, money), get_z_bscount = cgCheckSend.FloatSubtr(get_z_bscount, 1), get_z_allmoney = cgCheckSend.FloatSubtr(get_z_allmoney, money), LeftPintIframe.name().$.JOP.printnum--),
                    get_bscount = get_bscount <= 0 ? 0 : get_bscount,
                    get_allmoney = get_allmoney <= 0 ? 0 : get_allmoney,
                    get_z_bscount = get_z_bscount <= 0 ? 0 : get_z_bscount,
                    get_z_allmoney = get_z_allmoney <= 0 ? 0 : get_z_allmoney,
                    op.find("#_bscount").text(get_bscount),
                    op.find("#_allmoney").text(get_allmoney),
                    op.find("#_z_bscount").text(get_z_bscount),
                    op.find("#_z_allmoney").text(get_z_allmoney);
                    var lasttr = op.find("#orderlist tr:last td dd").html();
                    op.find("#orderlist tr#o_" + id).remove();
                    var ordercon = op.find("#orderlist tr").length;
                    if (0 == ordercon) op.find("#_datetime").text(""),
                    op.find("#_orderid").text(""),
                    op.find("#sorderid").val(""),
                    op.find("#_oidstr").val(""),
                    LeftPintIframe.name().$.JOP.printnum = 0;
                    else if (lasttr == myorder) {
                        var showlasttr = op.find("#orderlist tr:last td dd:eq(0)").html(),
                        showlastdate = op.find("#orderlist tr:last td dd:eq(1)").html();
                        op.find("#_orderid").text(showlasttr),
                        op.find("#_datetime").text(showlastdate)
                    }
                    if (ordercon > 0) {
                        var getstrid = "",
                        comm = "",
                        lastid = 0;
                        op.find("#orderlist tr").each(function() {
                            var setid = $(this).attr("id");
                            if ("" != setid) {
                                var getid = setid.split("_");
                                getstrid += comm + "" + getid[1],
                                comm = ",",
                                lastid = getid[1] > 0 ? getid[1] : lastid
                            }
                        })
                    }
                    op.find("#sorderid").val(getstrid),
                    op.find("#_oidstr").val(lastid > 0 ? "&oid=" + lastid: "&orid=" + showlasttr),
                    LeftPintIframe.name().$.JOP.printnum < 0 && (LeftPintIframe.name().$.JOP.printnum = 0)
                }
            }
        }),
        setTimeout("LeftPintIframe.name().$.JOP.Pload();", 200),
        setTimeout('$("#sendnumber").select()', 200)
    }
} (jQuery),
function($) {
    "use strict";
    $.jqPaginator = function(el, options) {
        if (! (this instanceof $.jqPaginator)) return new $.jqPaginator(el, options);
        var self = this;
        return self.$container = $(el),
        self.$container.data("jqPaginator", self),
        self.init = function() { (options.allnumpage || options.first || options.prev || options.next || options.last || options.page || options.pageInput) && (options = $.extend({},
            {
                allnumpage: "",
                first: "",
                prev: "",
                next: "",
                last: "",
                page: "",
                pageInput: ""
            },
            options)),
            self.options = $.extend({},
            $.jqPaginator.defaultOptions, options),
            self.verify(),
            self.extendJquery(),
            self.render()
        },
        self.verify = function() {
            var opts = self.options;
            if (!self.isNumber(opts.totalPages)) throw new Error("[jqPaginator] type error: totalPages");
            if (!self.isNumber(opts.totalCounts)) throw new Error("[jqPaginator] type error: totalCounts");
            if (!self.isNumber(opts.pageSize)) throw new Error("[jqPaginator] type error: pageSize");
            if (!self.isNumber(opts.currentPage)) throw new Error("[jqPaginator] type error: currentPage");
            if (!self.isNumber(opts.visiblePages)) throw new Error("[jqPaginator] type error: visiblePages");
            if (!opts.totalPages && !opts.totalCounts) throw new Error("[jqPaginator] totalCounts or totalPages is required");
            if (!opts.totalPages && !opts.totalCounts) throw new Error("[jqPaginator] totalCounts or totalPages is required");
            if (!opts.totalPages && opts.totalCounts && !opts.pageSize) throw new Error("[jqPaginator] pageSize is required");
            if (opts.totalCounts && opts.pageSize && (opts.totalPages = Math.ceil(opts.totalCounts / opts.pageSize)), opts.currentPage < 1 || opts.currentPage > opts.totalPages) throw new Error("[jqPaginator] currentPage is incorrect");
            if (opts.totalPages < 1) throw new Error("[jqPaginator] totalPages cannot be less currentPage")
        },
        self.extendJquery = function() {
            $.fn.jqPaginatorHTML = function(s) {
                return s ? this.before(s).remove() : $("<p>").append(this.eq(0).clone()).html()
            }
        },
        self.render = function() {
            self.renderHtml(),
            self.setStatus(),
            self.bindEvents()
        },
        self.renderHtml = function() {
            for (var html = [], pages = self.getPages(), i = 0, j = pages.length; i < j; i++) html.push(self.buildItem("page", pages[i]));
            self.isEnable("prev") && html.unshift(self.buildItem("prev", self.options.currentPage - 0 - 1)),
            self.isEnable("first") && html.unshift(self.buildItem("first", 1)),
            self.isEnable("allnumpage") && html.unshift(self.buildItem("allnumpage", self.options.totalPages)),
            self.isEnable("statistics") && html.unshift(self.buildItem("statistics")),
            self.isEnable("next") && html.push(self.buildItem("next", self.options.currentPage - 0 + 1)),
            self.isEnable("last") && html.push(self.buildItem("last", self.options.totalPages)),
            self.isEnable("pageinput") && html.push(self.buildItem("pageinput", self.options.currentPage)),
            self.options.wrapper ? self.$container.html($(self.options.wrapper).html(html.join("")).jqPaginatorHTML()) : self.$container.html(html.join(""))
        },
        self.buildItem = function(type, pageData) {
            return $(self.options[type].replace(/{{page}}/g, pageData).replace(/{{totalPages}}/g, self.options.totalPages).replace(/{{totalCounts}}/g, self.options.totalCounts)).attr({
                "jp-role": type,
                "jp-data": pageData
            }).jqPaginatorHTML()
        },
        self.setStatus = function() {
            var options = self.options; (!self.isEnable("first") || 1 === options.currentPage || options.visiblePages / 2 >= options.currentPage) && $("[jp-role=first]", self.$container).addClass(options.displayClass),
            self.isEnable("prev") && 1 !== options.currentPage || $("[jp-role=prev]", self.$container).addClass(options.displayClass),
            (!self.isEnable("next") || options.currentPage >= options.totalPages) && $("[jp-role=next]", self.$container).addClass(options.displayClass),
            (!self.isEnable("last") || options.currentPage >= options.totalPages || options.totalPages - options.visiblePages / 2 <= options.currentPage) && $("[jp-role=last]", self.$container).addClass(options.displayClass),
            self.isEnable("pageinput") || $("[jp-role=pageinput]", self.$container).addClass(options.activeClass),
            self.isEnable("allnumpage") && $("[jp-role=allnumpage]", self.$container).addClass(options.activeClass),
            $("[jp-role=page]", self.$container).removeClass(options.activeClass),
            $("[jp-role=page][jp-data=" + options.currentPage + "]", self.$container).addClass(options.activeClass)
        },
        self.getPages = function() {
            var pages = [],
            visiblePages = self.options.visiblePages,
            currentPage = self.options.currentPage,
            totalPages = self.options.totalPages;
            visiblePages > totalPages && (visiblePages = totalPages);
            var half = Math.floor(visiblePages / 2),
            start = currentPage - half + 1 - visiblePages % 2,
            end = currentPage - 0 + half;
            start < 1 && (start = 1, end = visiblePages),
            end > totalPages && (end = totalPages, start = 1 + totalPages - visiblePages);
            for (var itPage = start; itPage <= end;) pages.push(itPage),
            itPage++;
            return pages
        },
        self.isNumber = function(value) {
            var type = typeof value;
            return "number" === type || "undefined" === type
        },
        self.isEnable = function(type) {
            return self.options[type] && "string" == typeof self.options[type]
        },
        self.switchPage = function(pageIndex) {
            self.options.currentPage = pageIndex,
            self.render()
        },
        self.fireEvent = function(pageIndex, type) {
            return "function" != typeof self.options.onPageChange || self.options.onPageChange(pageIndex, type) !== !1
        },
        self.callMethod = function(method, options) {
            switch (method) {
            case "option":
                self.options = $.extend({},
                self.options, options),
                self.verify(),
                self.render();
                break;
            case "destroy":
                self.$container.empty(),
                self.$container.removeData("jqPaginator");
                break;
            default:
                throw new Error('[jqPaginator] method "' + method + '" does not exist')
            }
            return self.$container
        },
        self.bindEvents = function() {
            var opts = self.options;
            self.$container.off(),
            self.$container.on("click", "[jp-role]",
            function() {
                var $el = $(this);
                if ("pageinput" == $el.attr("jp-role")) return void $el.select();
                if (!$el.hasClass(opts.disableClass) && !$el.hasClass(opts.activeClass)) {
                    var pageIndex = +$el.attr("jp-data");
                    self.fireEvent(pageIndex, "change") && self.switchPage(pageIndex)
                }
            }),
            self.$container.on("keypress", "[jp-role=pageinput]",
            function(event) {
                var $el = $(this);
                if ("13" == event.keyCode) {
                    var pageIndex = $el.val();
                    self.fireEvent(pageIndex, "change") && self.switchPage(pageIndex)
                }
            })
        },
        self.init(),
        self.$container
    },
    $.jqPaginator.defaultOptions = {
        wrapper: "",
        allnumpage: '<li class="allnumpage">总 {{totalCounts}} 条</li>',
        first: '<li class="first"><a href="javascript:;">1..</a></li>',
        prev: '<li class="prev"><a href="javascript:;"><<</a></li>',
        next: '<li class="next"><a href="javascript:;">>></a></li>',
        last: '<li class="last"><a href="javascript:;">..{{totalPages}}</a></li>',
        page: '<li class="page"><a href="javascript:;">{{page}}</a></li>',
        pageinput: '<input class="pageinput" type="text" name="pageinput" value="">',
        totalPages: 0,
        totalCounts: 0,
        pageSize: 0,
        currentPage: 1,
        visiblePages: 7,
        disableClass: "disabled",
        activeClass: "active",
        displayClass: "displaynone",
        onPageChange: null
    },
    $.fn.jqPaginator = function() {
        var self = this,
        args = Array.prototype.slice.call(arguments);
        if ("string" == typeof args[0]) {
            var $instance = $(self).data("jqPaginator");
            if ($instance) return $instance.callMethod(args[0], args[1]);
            throw new Error("[jqPaginator] the element is not instantiated")
        }
        return new $.jqPaginator(this, args[0])
    }
} (jQuery);
var cgOrber = {
    divname: "SoonOrder",
    sid: "",
    getnum: 0,
    ordernum: 10,
    credits_remaining: 10,
    caizhongselect: 1,
    erzimode: 1,
    caizhongarr: {
        1 : "七星彩",
        2 : "排列5"
    },
    tuima: 0,
    entermode: 0,
    faststr: "",
    diyici: 0,
    isnumbermoney: 0,
    xianlu: {},
    classList: {},
    logout: function() {
       // location.href = "./index.php?action=logout"
    },
    chaturl: function(curl, gsid) {
        $("#cgchat_num").unbind("click").click(function() {
            $("#cgchat_num").text(""),
            $("#cgchat_num").addClass("cgchat_emain_no"),
            $("#cgchat_num").removeClass("cgchat_emain_yes");
            var host = window.location.host ? window.location.host: document.domain,
            hostnum = host.replace(/[^0-9]/gi, ""),
            hostarr = host.split("."),
            url = (4 == hostnum.length ? "8888.": "8.") + hostarr[1] + "." + hostarr[2],
            enurl = "http://" + url + "/?action=fast&sessid=2&gsid=" + gsid + "&inter_username=" + curl;
            return newwindow = window.open(enurl, "chatmsgwindow", "height=600,width=650,toolbar=no,menubar=no,scrollbars=no,resizable=no, location=no,status=no,depended=yes,alwaysLowered =yes,alwaysRaised =yes"),
            window.focus && newwindow.focus(),
            !1
        })
    },
    GetNews: function(data) {
        var json = eval(data),
        c = json.c;
        0 != isNull(c) && (html = '<table class="alertsPrint1 appnews" width="100%" align="center"><tbody><tr><td>' + c + "</td></tr></tbody></table>", jAlertPrint(html, "全部公告",
        function() {}))
    },
    GetsetPrint: function(data) {
        0 != isNull(data) && (data = data.replace(/\n/g, ""), jAlertPrint(data, "设置图示",
        function() {}))
    },
    GetSoonOrder: function(data) {
        var json = eval(data);
        if(json.code==200){
            var data=json.data;
            var html='';
            for(var i=0;i<10;i++){
                if(data[i]==undefined){
                    html+='<tr class="buqiOrder"><td>&nbsp;</td><td>--</td><td class="number">--</td><td class="frank">--</td><td class="money">--</td><td>--</td><td>--</td></tr>';
                }else{
                    if(data[i]['mingxi_1']=='4现'){
                        data[i]['mingxi_3']='现';
                    }else{
                        data[i]['mingxi_3']='';
                    }
                    if(data[i]['js']==0){
                        html+='<tr><td>七星彩</td><td>'+data[i]['did']+'</td><td class="number">'+data[i]['mingxi_2']+'<span>'+data[i]['mingxi_3']+'</span></td><td class="frank">'+data[i]['odds']+'</td><td class="money">'+data[i]['money']+'</td><td>成功</td><td><input id="checkboxID'+data[i]['id']+'" type="checkbox" value="'+data[i]['id']+'"></td></tr>';
                    }else{
                        html+='<tr class="tuima"><td>七星彩</td><td>'+data[i]['did']+'</td><td class="number">'+data[i]['mingxi_2']+'<span>'+data[i]['mingxi_3']+'</span></td><td class="frank">'+data[i]['odds']+'</td><td class="money">'+data[i]['money']+'</td><td>退码</td><td>--</td></tr>';   
                    }
                }
                
            }
            $('#SoonOrder').html(html);
        }
        // s = json.s;
        // if (s > 9e3) jAlert(data.m + "", "提示框",
        // function() {
        //     cgOrber.logout()
        // });
        // else if (s > 8e3) jAlert(data.m + "", "提示框",
        // function() {});
        // else if (200 == s) {
        //     $("#" + cgOrber.divname).empty(),
        //     cgOrber.sid = json.gsid,
        //     cgOrber.xianlu = json.xianlu,
        //     cgOrber.faststr = json.faststr,
        //     cgOrber.classList = json.classList;
        //     var get_credits_use = json.credits_use - 0,
        //     get_credits_use = Number(get_credits_use.toFixed(2));
        //     getUserInfo.setInfo(get_credits_use, json.credits_remaining),
        //     cgOrber.caizhongselect = json.caizhongselect,
        //     cgOrber.erzimode = json.erzimode;
        //     var gifid = json.gifid;
        //     if (0 == cgOrber.diyici) {
        //         var czs = cgOrber.caizhongselect;
        //         cgOrber.addCssFile(czs),
        //         1 == json.jsggmode && job_show_window(json.jsgg),
        //         gifid > 0 && czs > 0 ? ($(".top").addClass("top_" + gifid), $(".topbj").addClass("top_bj_" + gifid)) : ($(".top").addClass("top_1"), $(".topbj").addClass("top_bj_1")),
        //         $(".gun_name").html(cgOrber.caizhongarr[cgOrber.caizhongselect]),
        //         cgOrber.diyici = 1
        //     }
        //     cgOrber.getnum = 0,
        //     cgOrber.tuima = 0,
        //     cgOrber.addAll(json.w),
        //     $("#sotpnumber").cgStopNumberFn({
        //         stopnumberdata: json.stopnumber[0],
        //         PagerId: "stopnumberPager",
        //         stopnumberdel: 0
        //     }),
        //     $("#sotpnumberdel").cgStopNumberDelFn({
        //         stopnumberdata: json.stopnumberdel[0],
        //         PagerId: "stopnumberdelPager",
        //         stopnumberdel: 1
        //     }),
        //     cgOrber.IssueonSelect(json.issuemenu),
        //     cgOrber.chaturl(json.faststr, json.gsid),
        //     cgDetail.so_s_classid(cgOrber.classList),
        //     cgOrber.isnumbermoney = json.isnumbermoney,
        //     1 == json.isnumbermoney ? $(".nav_top li [rel=tab_pass]").click() : 2 == json.isnumbermoney ? $(".top_kaida li [rel=tab_kuaixuan]").click() : 3 == json.isnumbermoney && $(".top_kaida li [rel=tab_import]").click(),
        //     cgOrber.entermode = json.entermode,
        //     $("#tab_kuaida #stopnumberBox").attr("checked", !1),
        //     $("#tab_kuaida #checkboxALLID").attr("checked", !1)
        // } else jAlert("未知111错误", "提示框",
        // function() {})
    },
    addCssFile: function(s) {
        var czs = 2 == s ? "mystyle5.css": "mystyle7.css",
        css_href = "./admincg/css/" + czs,
        styleTag = document.createElement("link");
        styleTag.setAttribute("type", "text/css"),
        styleTag.setAttribute("rel", "stylesheet"),
        styleTag.setAttribute("href", css_href),
        $("head")[0].appendChild(styleTag)
    },
    IssueonSelect: function(issuemenu) {
        $("#s_issueon").empty(),
        $("#s_issueon").html(),
        $.each(issuemenu,
        function(i) {
            $("#s_issueon").val() || $("#s_issueon").val(issuemenu[i]),
            $("#s_issueon").append("<option value='" + issuemenu[i] + "'>" + issuemenu[i] + "</option>")
        }),
        $("#s_issueon").on("change",
        function(e, params) {
            var s_issueon = $(this).val();
            jsonAjax("appindexajax.php", "get", "action=stopnumberrefresh&delstat=0&s_issueon=" + s_issueon + "&iCurrPage=0", "json", cgStopNumber.getData),
            jsonAjax("appindexajax.php", "get", "action=stopnumberrefresh&delstat=1&s_issueon=" + s_issueon + "&iCurrPage=0", "json", cgStopNumberDel.getData)
        })
    },
    buqiOrder: function(num) {
        if (num > this.ordernum) return ! 1;
        for (var i = num; i < this.ordernum; i++) {
            $("#" + this.divname).append('<tr class="buqiOrder"><td>&nbsp;</td><td>--</td><td class="number">--</td><td class="frank">--</td><td class="money">--</td><td>--</td><td>--</td>')
        }
    },
    addAll: function(orderlist) {
        0 != isNull(orderlist) && $.each(orderlist,
        function(ii, item) {
            var id = orderlist[ii].id,
            orderid = orderlist[ii].orderid,
            number = orderlist[ii].number,
            frank = orderlist[ii].frank,
            money = orderlist[ii].money,
            statsizi = orderlist[ii].statsizi,
            classid = orderlist[ii].classid,
            stattuima = orderlist[ii].stattuima,
            hotstat = orderlist[ii].hotstat,
            tuima = orderlist[ii].tuima,
            sizitext = "",
            tuimatext = "退码",
            stattext = "成功",
            hotcss = "";
            1 != statsizi && 6 != classid && 7 != classid || (sizitext = "现"),
            1 == stattuima ? (tuimatext = "--", hotcss = 'class="tuima"', stattext = "退码") : (1 == hotstat && (hotcss = 'class="hotcss"'), tuimatext = 2 == tuima || 3 == tuima || 1 == cgOrber.tuima ? '<input id="checkboxID' + id + '" type="checkbox" value="' + id + '"/>': "--");
            var html = "<tr " + hotcss + "><td>" + cgOrber.caizhongarr[cgOrber.caizhongselect] + "</td><td>" + orderid + '</td><td class="number">' + number + "<span>" + sizitext + '</span></td><td class="frank">' + frank + '</td><td class="money">' + money + "</td><td>" + stattext + "</td><td>" + tuimatext + "</td>";
            $("#" + cgOrber.divname).append(html),
            cgOrber.getnum++
        }),
        cgOrber.buqiOrder(cgOrber.getnum),
        orderlist = "",
        html = ""
    },
    init: function() {
        $("#sendnumber").KdlimitMoneyX(),
        $("#sendnumber").focus().select(),
        $("#sendmoney").limitMoneyPoint(),
        $("#checkboxALLID").attr("checked", !1),
        $("#checkboxALLID").unbind("click").click(function() {
            1 == this.checked ? $("#SoonOrder input[type=checkbox]").checkBox("all") : $("#SoonOrder input[type=checkbox]").checkBox("none")
        }),
        1 == IsPC() && $(".main_left").addClass("leftprintscroll")
    }
},
cgCheckSend = {
    __nID: "sendnumber",
    __mID: "sendmoney",
    __number: "",
    __money: 0,
    __credits_remaining: 0,
    __classid: 0,
    init: function() {
        $("#sendsizi").attr("checked", !1),
        $("#sendqz").attr("checked", !1),
        $("#sendsizi").unbind("click").click(function() {
            $(this).prop("checked") ? ($("#sendqz").prop("checked", !1), $("#sendxian").show()) : $("#sendxian").hide()
        }),
        $("#sendqz").unbind("click").click(function() {
            $(this).prop("checked") && ($("#sendsizi").prop("checked", !1), $("#sendxian").hide())
        }),
        $("#sendxiazhu").unbind("click").click(function() {
            cgCheckSend.isChack()
        }),
        $("#" + this.__nID).keypress(function(event) {
            13 == (event.keyCode ? event.keyCode: event.which) && cgCheckSend.CheckEditText(this)
        }),
        $("#" + this.__nID).keyup(function(event) {
            0 == cgOrber.entermode && $(this).val().length > 3 && cgCheckSend.CheckEditText(this)
        }),
        $("#" + this.__mID).keypress(function(event) {
            event.keyCode ? event.keyCode: event.which;
            13 == event.keyCode && cgCheckSend.CheckEditText(this)
        }),
        $("#xiazhutuima").unbind("click").click(function() {
            cgCheckSend.sendTuima()
        }),
        $("#xiazhutuima1").unbind("click").click(function() {
            cgCheckSend.sendTuima()
        }),
        $("#sendxian").hide(),
        $(".frankmoney").hide()
    },
    isNumberKey: function() {
        $("#" + this.__nID).val(""),
        $("#" + this.__nID).focus().select()
    },
    isMoneyKey: function() {
        $("#" + this.__mID).focus().select()
    },
    FloatAdd: function(arg1, arg2) {
        var r1, r2, m;
        try {
            r1 = arg1.toString().split(".")[1].length
        } catch(e) {
            r1 = 0
        }
        try {
            r2 = arg2.toString().split(".")[1].length
        } catch(e) {
            r2 = 0
        }
        return m = Math.pow(10, Math.max(r1, r2)),
        (arg1 * m + arg2 * m) / m
    },
    FloatSubtr: function(arg1, arg2) {
        return cgCheckSend.FloatAdd(arg1, -arg2)
    },
    CheckEditText: function(t) {
        if (id = $(t).attr("id"), this.__number = $("#" + this.__nID).val().toUpperCase(), id == this.__nID) this.__number.length > 1 ? (this.getSoonHitFrank(), this.isMoneyKey()) : $("#" + cgCheckSend.__nID).focus().select();
        else if (id == this.__mID) {
            var stats = this.CacheNumber();
            200 == stats ? this.isChack() : this.showNumber(stats,
            function() {
                return $("#" + cgCheckSend.__nID).focus().select(),
                !1
            })
        }
    },
    sendTuima: function() {
        var strid = "";
        strid = $("#SoonOrder input[type=checkbox]").checkedValue(),
        "" == strid || jsonAjax("/index.php/Index/tuima", "POST", "action=ordertuima&tuimaid=" + strid, "json", cgCheckSend.showSendTuima)
    },
    showSendTuima: function(data) {
        var json = eval(data);
        if(json.code==200){
            jsonAjax("/index.php/Index/xiazhukuang","get", "action=soonorder"+ "&time=" + new Date().getMilliseconds(), "json", cgOrber.GetSoonOrder);
                    leftprint.location.reload(); 
             //cgOrber.logout();
             //return $(window.frames.leftprint.document);
        }   
        // s = json.s;
        // if (s > 9e3) 
        // jAlert(json.m + "", "提示框",
        // function() {
        //     cgOrber.logout()
        // });
        // else if (s > 8e3);
        // else if (200 == s) {
        //     var get_credits_use = json.credits_use - 0,
        //     get_credits_use = Number(get_credits_use.toFixed(2));
        //     cgOrber.credits_use = get_credits_use,
        //     getUserInfo.setInfo(get_credits_use, json.credits_remaining),
        //     $("#SoonOrder input[type=checkbox]").checkedEditCss()
        // }
    },
    SendSoonHit: function() {
        var moneyall = 0;
        $("#sendxian").hide();
        var mSzx = 0;
        this.isSendszx() && (mSzx = 1);
        var number = this.__number,
        money = this.__money,
        number_money = number + "," + money + "," + mSzx,
        QZnumber = this.getQuanZhuan24();
        if ("" != QZnumber ? (number_money = QZnumber, moneyall = this.__moneyall, LeftPintIframe.name().$.JOP.printnum = 0) : moneyall = money, getUserInfo.credits_remaining() < moneyall) return jAlert("信用额度不足！", "提示框",
        function() {
            $("#" + cgCheckSend.__mID).focus().select()
        }),
        !1;
        cgCheckSend.isNumberKey(),
        sendAjax("appindexajax.php", "POST", "action=soonsend&post_number=" + number_money + "&sizixian=" + mSzx + "&sid=" + cgOrber.sid + "&inajax=1", "json", cgCheckSend.showSendSoonHit,
        function() {},
        function() {}),
        playmsg("msg2.MP3")
    },
    showSendSoonHit: function(data) {
        var json = eval(data),
        s = json.s;
        if (s > 9e3) jAlert(json.m + "", "提示框",
        function() {
            cgOrber.logout()
        });
        else if (s > 8e3 || 4 == s) jAlert(json.m + "", "提示框",
        function() {});
        else {
            var showstats = !0,
            getorders = json.orders;
            "" == getorders.j && (showstats = !1);
            var get_credits_use = json.credits_use - 0,
            get_credits_use = Number(get_credits_use.toFixed(2));
            getUserInfo.setInfo(get_credits_use, json.credits_remaining),
            1 == json.kazhuan ? (LeftPintIframe.refresh(), jsonAjax("appindexajax.php", "get", "action=soonorder&diyici=1", "json", cgOrber.GetSoonOrder)) : 1 == s ? cgCheckSend.insterStopNumber(data) : 2 == s ? (showstats && cgCheckSend.insterNumber(json), cgCheckSend.insterStopNumber(data)) : showstats && cgCheckSend.insterNumber(json)
        }
    },
    insterStopNumber: function(json) {
        cgStopNumber.showHtml(json.stopnumber[0], 1)
    },
    insterNumber: function(json) {
        var data = json.orders,
        getOrders = data.j;
        getOrders.length >= cgOrber.ordernum ? (cgOrber.getnum = 0, $("#" + cgOrber.divname).empty()) : cgOrber.getnum < cgOrber.ordernum ? $("#" + cgOrber.divname + " tr.buqiOrder").remove() : cgOrber.getnum >= cgOrber.ordernum && $("#" + cgOrber.divname + " tr:eq(0)").remove(),
        cgOrber.tuima = 1,
        cgOrber.addAll(getOrders),
        LeftPintIframe.name().$.JOP.iniPage(0, data)
    },
    getSoonHitFrank: function() {
        // var mSzx = 0;
        // this.isSendszx() && (mSzx = 1),
        // jsonAjax("appindexajax.php", "get", "action=chacknumbermoney&post_number=" + this.__number + "&sizixian=" + mSzx + "&sid=" + cgOrber.sid + "&inajax=1", "json", cgCheckSend.showSoonHitFrank)
    },
    showSoonHitFrank: function(data) {
        var json = eval(data),
        s = json.s;
        if (s > 9e3) jAlert(json.m + "", "提示框",
        function() {
            cgOrber.logout()
        });
        else if (s > 8e3) jAlert(json.m + "", "提示框",
        function() {});
        else if (200 == s) {
            var arr = json.w[0];
            0 == arr.kexia ? $(".frankmoney").hide() : $(".frankmoney").show(),
            $("#sfrank").html(arr.frank),
            $("#smoney").html(arr.money)
        } else jAlert("未知错误", "提示框",
        function() {})
    },
    isLenNumber: function(str) {
        return str.length > 4
    },
    isChack: function() {
        this.__money = $("#" + this.__mID).val(),
        getUserInfo.credits_remaining() <= 0 && jAlert("信用额度不足！", "提示框",
        function() {}),
        this.__number = $("#" + this.__nID).val().toUpperCase();
        var stats = this.CacheNumber();
        200 == stats ? (stats = this.CacheMoney(), 200 == stats ? this.SendSoonHit() : this.showMoney(stats,
        function() {
            return $("#" + cgCheckSend.__mID).focus().select(),
            !1
        })) : this.showNumber(stats,
        function() {
            return $("#" + cgCheckSend.__nID).focus().select(),
            !1
        })
    },
    numberReg: function(a) {
        return /^[xX0-9]+$/.test(a)
    },
    getXlength: function(s) {
        return s.split("X").length - 1
    },
    isSendszx: function() {
        return $("#sendsizi").prop("checked")
    },
    isSendqz: function() {
        return $("#sendqz").prop("checked")
    },
    texisNumber: function(number) {
        if (number = number.split(""), 0 != number.length) {
            var number_now = number.sort(),
            num = "";
            for (i = 0; i <= number_now.length - 1; i++) num += number_now[i];
            $("#" + this.__nID).val(num),
            this.__number = num
        }
    },
    getClassid: function(k) {
        var getid = 0,
        mClassList = cgOrber.classList,
        number = this.__number;
        for (i in mClassList) if (mClassList[i].pid == k) {
            var n = mClassList[i].n;
            if (getn = number.replace(/[0-9]/gm, "口"), n == getn) {
                getid = mClassList[i].cid;
                break
            }
        }
        return getid
    },
    CacheNumber: function() {
        var s = 200;
        if (!this.numberReg(this.__number)) return s = 2;
        var numberlen = this.__number.length,
        xlen = this.getXlength(this.__number);
        return 0 == numberlen ? s = 0 : numberlen <= 1 || numberlen > 4 || xlen > 0 && numberlen < 4 ? s = 1 : xlen > 2 && (s = 3),
        0 == xlen && (numberlen <= 3 || this.isSendszx()) && $("#tab_kuaida").is(":visible") && this.texisNumber(this.__number),
        xlen > 0 ? this.__classid = 2 == xlen ? this.getClassid(1) : this.getClassid(4) : 4 == numberlen && this.isSendszx() ? this.__classid = 107 : 4 == numberlen ? this.__classid = 5 : 3 == numberlen ? this.__classid = 7 : 2 == numberlen && (this.__classid = 6),
        xlen > 0 ? $("#sendxian").hide() : numberlen <= 3 || this.isSendszx() ? $("#sendxian").show() : $("#sendxian").hide(),
        s
    },
    isDian: function(n) {
        var money = n + "",
        s = !1;
        if (money.indexOf(".") != -1) {
            var arr = money.split(".");
            if (arr.length > 1) {
                s = parseInt(arr[1]) > 0
            }
        }
        return s
    },
    moneymsg: "",
    CacheMoney: function() {
        var s = 200,
        money = this.__money;
        if (!$.isNumeric(money)) return 5;
        if ("" == money || void 0 == money || null == money) return 6;
        mClassList = cgOrber.classList;
        var classid = this.__classid;
        if (! (classid > 0)) return 4;
        for (var getmoney = money - 0,
        o = 0,
        l = 0,
        cid = 0,
        ollen = mClassList.length - 0,
        i = 0; i < ollen; i++) if (cid = mClassList[i].cid, cid == classid) {
            o = mClassList[i].o - 0,
            l = mClassList[i].l - 0;
            break
        }
        var zuixiao = l;
        return getmoney > o ? (s = 1, cgCheckSend.moneymsg = o) : getmoney < l ? (s = 2, cgCheckSend.moneymsg = l) : !this.isDian(zuixiao) && this.isDian(money) && (s = 3),
        s
    },
    __moneyall: 0,
    getQuanZhuan24: function() {
        var QZnumber = "",
        str = this.__number,
        money = this.__money;
        if (this.moneyall = 0, 4 == str.length && this.isSendqz() && !this.isSendszx()) {
            var MapNumber = {};
            n1 = str.substr(0, 1),
            n2 = str.substr(1, 1),
            n3 = str.substr(2, 1),
            n4 = str.substr(3, 1);
            var i, j, k, l, nostr, ckstr = "",
            comm = "",
            aj1 = 0;
            for (i = 1; i <= 4; i++) for (j = 1; j <= 4; j++) for (k = 1; k <= 4; k++) for (l = 1; l <= 4; l++) i != j && i != k && i != l && j != k && j != l && k != l && (nostr = eval("n" + i) + "" + eval("n" + j) + eval("n" + k) + eval("n" + l), null != ckstr && ckstr.indexOf(nostr) >= 0 || (ckstr += nostr + ",", aj1 = this.FloatAdd(aj1, money), QZnumber += comm + nostr + "," + money + ",0", comm = "|"));
            this.__moneyall = aj1
        }
        return QZnumber
    },
    showNumber: function(stats, fun) {
        var str = "";
        switch (stats) {
        case 0:
            str = "请填写号码！";
            break;
        case 1:
            str = "没有该号码！";
            break;
        case 2:
            str = "号码只允许数字和X号！";
            break;
        case 3:
            str = "号码最多2个X号！";
            break;
        case 4:
            str = "没有该号码！"
        }
        //"" != str && jAlert(str + "", "提示框", fun)
    },
    showMoney: function(stats, fun) {
        var str = "";
        switch (stats) {
        case 1:
            str = "不能超出单注上限" + cgCheckSend.moneymsg + "！";
            break;
        case 2:
            str = "下注金额不能低于" + cgCheckSend.moneymsg + "！";
            break;
        case 3:
            str = "金额不能带小数点！";
            break;
        case 4:
            str = "没有该号码！";
            break;
        case 5:
            str = "金额必须为数字！";
            break;
        case 6:
            str = "金额不能为空！"
        }
        //"" != str && jAlert(str + "", "提示框", fun)
    }
}; !
function(window, $) {
    var cgStopNumber = window.cgStopNumber = {
        opts: {
            stopnumberdata: {},
            stopnumberdel: 0,
            numpage: 2,
            allpage: 0,
            s_issueon: 0,
            PagerId: 0
        },
        pagerElement: null,
        init: function(obj, op) {
            var _self = this;
            return _self.opts = $.extend({},
            _self.opts, op),
            _self.pagerElement = obj,
            _self.showHtml(_self.opts.stopnumberdata),
            $("#stopnumberBox").attr("checked", !1),
            $("#stopnumberBox").unbind("click").click(function() {
                1 == this.checked ? _self.pagerElement.find("input[type=checkbox]").checkBox("all") : _self.pagerElement.find("input[type=checkbox]").checkBox("none")
            }),
            $("#stopnumberBtnDel").unbind("click").click(function() {
                _self.stopnumbeBtnDel()
            }),
            _self.opts
        },
        showHtml: function(data) {
            if (void 0 == data) return ! 1;
            var allnum = data.allnum,
            allmoney = data.allmoney,
            pages = data.pages,
            dataitem = data.stopnumberitem,
            html = "",
            num = 0;
            $.each(dataitem,
            function(ii, item) {
                var number = dataitem[ii].number,
                money = dataitem[ii].money,
                gid = dataitem[ii].id,
                hotstat = dataitem[ii].hotstat,
                statsizi = dataitem[ii].statsizi,
                classid = dataitem[ii].classid,
                colorlast = dataitem[ii].colorlast,
                datetime = dataitem[ii].datetime;
                html += cgStopNumber.setHtml(number, money, gid, hotstat, statsizi, classid, colorlast, datetime),
                num++
            }),
            html += cgStopNumber.initHtml(num),
            html += cgStopNumber.sethejiHtml(allnum, allmoney),
            cgStopNumber.pagerElement.html(html),
            0 == pages && cgStopNumber.setPage(data.numpage, data.allnum, data.allpage),
            data = ""
        },
        stopnum: 8,
        initHtml: function(n) {
            if (n > cgStopNumber.stopnum) return "";
            for (var html = "",
            i = n; i < cgStopNumber.stopnum; i++) html += "<tr><td>--</td><td>--</td><td>--</td></tr>";
            return html
        },
        setHtml: function(n, m, gid, s, x, c, t, d) {
            var _self = this,
            hotcss = "",
            sizitext = "",
            number1 = "",
            money1 = "";
            1 == s && (hotcss = 'class="hotcss"'),
            1 != x && 6 != c && 7 != c || (sizitext = "<span>现</span>"),
            1 == t && (number1 = 'class="number"', money1 = 'class="money"');
            var boxhtml = "";
            return 0 == _self.opts.stopnumberdel ? boxhtml = '<td><input  type="checkbox" value="' + gid + '"/></td>': hotcss = 'class="tuima"',
            "<tr " + hotcss + ' title="' + d + '"><td ' + number1 + ">" + n + sizitext + "</td><td " + money1 + ">" + m + "</td>" + boxhtml + "</tr>"
        },
        sethejiHtml: function(b, m) {
            return '<tr><td colspan="3" class="heji">笔数:' + b + "  总金额:" + m + "</td>"
        },
        stopnumbeBtnDel: function() {
            var _self = this,
            delid = "";
            if (delid = _self.pagerElement.find("input[type=checkbox]").checkedValue(), "" == delid) return jAlert("请选择要删除的停押号码！", "提示框",
            function() {}),
            !1;
            jsonAjax("appindexajax.php", "POST", "action=stopnumberdel&delid=" + delid + "&s_issueno=" + $("#s_issueon").val(), "json", cgStopNumber.stopnumbeBtnDelShow)
        },
        stopnumbeBtnDelShow: function(data) {
            var json = eval(data),
            s = json.s;
            s > 9e3 ? jAlert(json.m + "", "提示框",
            function() {
                cgOrber.logout()
            }) : s > 8e3 ? jAlert(json.m + "", "提示框",
            function() {}) : 200 == s && ($("#sotpnumber").cgStopNumberFn({
                stopnumberdata: json.stopnumber[0],
                PagerId: "stopnumberPager",
                stopnumberdel: 0
            }), $("#sotpnumberdel").cgStopNumberDelFn({
                stopnumberdata: json.stopnumberdel[0],
                PagerId: "stopnumberdelPager",
                stopnumberdel: 1
            }))
        },
        getData: function(data) {
            var json = eval(data),
            s = json.s;
            s > 9e3 ? jAlert(json.m + "", "提示框",
            function() {
                cgOrber.logout()
            }) : s > 8e3 ? jAlert(json.m + "", "提示框",
            function() {}) : 200 == s && cgStopNumber.showHtml(json.stopnumber[0])
        },
        setPage: function(numpage, allnum, allpage) {
            var _self = this;
            if (0 == allnum) $("#" + _self.opts.PagerId).hide();
            else {
                $("#" + _self.opts.PagerId).show();
                var s_issueon = $("#s_issueon").val();
                $("#" + _self.opts.PagerId).jqPaginator({
                    totalCounts: allnum,
                    totalPages: allpage,
                    visiblePages: 5,
                    currentPage: allpage,
                    wrapper: "",
                    onPageChange: function(num, type) {
                        jsonAjax("appindexajax.php", "get", "action=stopnumberrefresh&delstat=0&s_issueon=" + s_issueon + "&iCurrPage=" + num, "json", cgStopNumber.getData)
                    }
                })
            }
        },
        setPrintPage: function(allnum, numpage, page) {
            if (0 == allnum) $("#PrintPager").hide();
            else {
                $("#PrintPager").show();
                var s_issueon = $("#s_issueon").val();
                $("#PrintPager").jqPaginator({
                    totalCounts: allnum,
                    pageSize: numpage,
                    visiblePages: 10,
                    currentPage: page,
                    wrapper: "",
                    onPageChange: function(num, type) {
                        jsonAjax("appindexajax.php", "get", "action=stopnumberrefresh&doaction=print&s_issueon=" + s_issueon + "&iCurrPage=" + num, "json", cgStopNumber.getPrintData)
                    }
                })
            }
        },
        getPrintData: function(data) {
            var json = eval(data),
            s = json.s;
            s > 9e3 ? jAlert(json.m + "", "提示框",
            function() {
                cgOrber.logout()
            }) : s > 8e3 ? jAlert(json.m + "", "提示框",
            function() {}) : 200 == s && cgStopNumber.stopnumberPrint(json.stopnumber[0])
        },
        stopnumberPrint: function(json) {
            var dlist = json.stopnumberitem,
            html = "",
            num = 1,
            allm = 0;
            0 != isNull(dlist) && $.each(dlist,
            function(ii, item) {
                if (!isNull(dlist[ii])) return ! 0;
                var s = dlist[ii].s,
                sizitext = "";
                0 != isNull(s) && (sizitext = "<span>现</span>"),
                1 == num && (html += "<tr>");
                var n = dlist[ii].number,
                m = dlist[ii].money;
                html += "<td>" + n + sizitext + "=" + m + "</td>",
                allm = cgCheckSend.FloatAdd(allm, m),
                8 == num && (html += "</tr>", num = 0),
                num++
            });
            var date = new Date,
            month = date.getMonth() + 1,
            day = date.getDate();
            return allm = Number(allm.toFixed(2)),
            html += '<tr><td  style="border-top:1px solid #000000;height:28px;line-height:19px;" colspan="8">&nbsp;&nbsp;&nbsp;&nbsp;合计:' + allm + "</td></tr>",
            html = '<table class="alertsPrint1 alertsPrint2" width="100%" align="center"><tbody>' + html + "</tbody></table>",
            jAlertPrint(html, "第" + json.issueno + "期 目前停押号码  " + month + "月" + day + "日",
            function() {}),
            dlist = "",
            html = "",
            json.allpage - 0 > 1 && cgStopNumber.setPrintPage(json.allnum - 0, json.numpage - 0, 0 == json.pages ? json.allpage: json.pages),
            !1
        }
    };
    $.fn.cgStopNumberFn = function(option) {
        return cgStopNumber.init($(this), option)
    },
    $.fn.cgStopNumberDelFn = function(option) {
        this.each(function() {})
    }
} (window, jQuery),
function(window, $) {
    var cgStopNumberDel = window.cgStopNumberDel = {
        opts: {
            stopnumberdata: {},
            stopnumberdel: 1,
            numpage: 2,
            allpage: 0,
            s_issueon: 0,
            PagerId: 0
        },
        pagerElementDel: null,
        init: function(obj, op) {
            var _self = this;
            return _self.opts = $.extend({},
            _self.opts, op),
            _self.pagerElementDel = obj,
            _self.showHtml(_self.opts.stopnumberdata),
            _self.opts
        },
        showHtml: function(data) {
            if (void 0 == data) return ! 1;
            var allnum = data.allnum,
            allmoney = data.allmoney,
            pages = data.pages,
            dataitem = data.stopnumberitem,
            html = "",
            num = 0;
            $.each(dataitem,
            function(ii, item) {
                var number = dataitem[ii].number,
                money = dataitem[ii].money,
                gid = dataitem[ii].id,
                hotstat = dataitem[ii].hotstat,
                statsizi = dataitem[ii].statsizi,
                classid = dataitem[ii].classid,
                colorlast = dataitem[ii].colorlast;
                html += cgStopNumberDel.setHtml(number, money, gid, hotstat, statsizi, classid, colorlast),
                num++
            }),
            html += cgStopNumberDel.initHtml(num),
            html += cgStopNumberDel.sethejiHtml(allnum, allmoney),
            cgStopNumberDel.pagerElementDel.html(html),
            0 == pages && cgStopNumberDel.setdelPage(data.numpage, data.allnum, data.allpage)
        },
        initHtml: function(n) {
            if (n > cgStopNumber.stopnum) return "";
            for (var html = "",
            i = n; i < cgStopNumber.stopnum; i++) html += "<tr><td>--</td><td>--</td></tr>";
            return html
        },
        setHtml: function(n, m, gid, s, x, c, t) {
            var hotcss = "",
            sizitext = "";
            return 1 != x && 6 != c && 7 != c || (sizitext = "<span>现</span>"),
            hotcss = 'class="tuima"',
            "<tr " + hotcss + "><td>" + n + sizitext + "</td><td>" + m + "</td></tr>"
        },
        sethejiHtml: function(b, m) {
            return '<tr><td colspan="2" class="heji">笔数:' + b + "  总金额:" + m + "</td>"
        },
        getData: function(data) {
            var json = eval(data),
            s = json.s;
            s > 9e3 ? jAlert(json.m + "", "提示框",
            function() {
                cgOrber.logout()
            }) : s > 8e3 ? jAlert(json.m + "", "提示框",
            function() {}) : 200 == s && cgStopNumberDel.showHtml(json.stopnumber[0])
        },
        setdelPage: function(numpage, allnum, allpage) {
            var _self = this;
            if (0 == allnum) $("#" + _self.opts.PagerId).hide();
            else {
                $("#" + _self.opts.PagerId).show();
                var s_issueon = $("#s_issueon").val();
                $("#" + _self.opts.PagerId).jqPaginator({
                    disableClass: "disabled",
                    totalCounts: allnum,
                    totalPages: allpage,
                    visiblePages: 5,
                    currentPage: allpage,
                    onPageChange: function(num, type) {
                        jsonAjax("appindexajax.php", "get", "action=stopnumberrefresh&delstat=1&s_issueon=" + s_issueon + "&iCurrPage=" + num, "json", cgStopNumberDel.getData)
                    }
                })
            }
        }
    };
    $.fn.cgStopNumberDelFn = function(option) {
        return cgStopNumberDel.init($(this), option)
    }
} (window, jQuery);
var cgSelect = {
    logid: 0,
    credits_remaining: 0,
    credits_use: 0,
    credits_use_all: 0,
    isnumbermoney: 0,
    divname: "SoonSelect",
    __mID: "selectmoney",
    GetSoonSelect: function(data) {
        var json = eval(data),
        s = json.s;
        if (s > 9e3) jAlert(data.m + "", "提示框",
        function() {
            cgOrber.logout()
        });
        else if (s > 8e3) jAlert(data.m + "", "提示框",
        function() {});
        else if (200 == s) {
            0 == json.openclose ? ($("#tab_kuaixuan").find("div").eq(0).show(), $("#tab_kuaixuan").find("div").eq(1).hide()) : ($("#tab_kuaixuan").find("div").eq(0).hide(), $("#tab_kuaixuan").find("div").eq(1).show()),
            $("#sendsoonselect_but").attr("disabled", !1),
            cgSelect.sendstat = !1;
            var obj = {},
            szd = 2;
            if ("" != json) {
                var obj = json,
                props = "";
                for (var p in obj)"setsoon" == p ? _soonset = obj[p] : 1 == obj.sidingwei ? ($(".menusoonselect").find("tr").find("td:eq(2)").show(), szd = 1) : $(".menusoonselect").find("tr").find("td:eq(2)").hide();
                var tdeq = 0;
                json.logsszd > 0 && (szd = json.logsszd, tdeq = szd - 1),
                $(".menusoonselect").find("tr").children("td").removeClass("active"),
                $(".menusoonselect").find("tr").find("td:eq(" + tdeq + ")").addClass("active"),
                $("#zjzc").val(0),
                cgSelect.credits_remaining = json.credits_remaining,
                cgSelect.credits_use = json.credits_use,
                1 == json.isnumbermoney ? cgSelect.BoltNumber(json.selectnumber) : json.logsszd > 0 ? (cgSelect.__showmeun(szd), document.selectForm.reset(), cgSelect.setVal(), $("#selectlogsclassid").val(szd), $("#zjzc").val(1), $.cachedScript("./admincg/javascript/cg.select.import.js").done(function() {
                    cgSelectImport.parsing(json.logsszd, json.logsstr)
                }).fail(function() {
                    jAlert("加载文件失败，请重新操作！", "提示框",
                    function() {
                        return ! 1
                    })
                }), cgSelect.logid = 0) : $("#setsoonclass2").click()
            }
        } else jAlert("未知错误", "提示框",
        function() {})
    },
    isChack: function() {
        this.mMoney = $("#" + this.__mID).val() - 0,
        allmoney = Math.floor($("#selectnumbermoney").text()),
        0 == allmoney && (this.totalmoney(this.mMoney), allmoney = Math.floor($("#selectnumbermoney").text()));
        var get_credits_remaining = getUserInfo.credits_remaining();
        if (get_credits_remaining <= 0 || allmoney > get_credits_remaining) return jAlert("信用额度不足！", "提示框",
        function() {}),
        !1;
        var s = $("#selectnumber").val();
        if ("" == s || null == s) return jAlert("请在右边生成号码！", "提示框",
        function() {}),
        !1;
        if (this.mMoney <= 0) return jAlert("请填写金额！", "提示框",
        function() {
            $("#" + cgSelect.__mID).select()
        }),
        !1;
        var s_arr = s.split(","),
        gNumber = s_arr[0];
        this.mNumber = s,
        this.getNumberCount = s_arr.length,
        cgCheckSend.__number = gNumber.toUpperCase(),
        cgCheckSend.__money = this.mMoney;
        var stats = cgCheckSend.CacheNumber();
        200 == stats ? (stats = cgCheckSend.CacheMoney(), 200 == stats ? (cgSelect.lujingstat = 3, $("#" + this.__mID).val(""), cgSelect.sendstat = !0, $(this).attr("disabled", !0), this.SendSoonSelectInit()) : cgCheckSend.showMoney(stats,
        function() {
            return $("#" + cgSelect.__mID).select(),
            !1
        })) : cgCheckSend.showNumber(stats,
        function() {
            return ! 1
        }),
        s = ""
    },
    getNumberCount: 0,
    pagenum: 400,
    pages: 1,
    pagesAdd: 1,
    pagesOercentage: 0,
    return_stats: 0,
    strarray: "",
    mNumber: "",
    mMoney: 0,
    selectlogs: "",
    selectlogsclassid: 0,
    zjzc: 0,
    selectnumbertotal_hidden: 0,
    xian: 0,
    lujingstat: 3,
    SendSoonSelectInit: function() {
        this.zjzc = $("#zjzc").val(),
        this.selectlogsclassid = $("#selectlogsclassid").val(),
        this.selectnumbertotal_hidden = $("#selectnumbertotal_hidden").val(),
        this.selectlogs = $("#selectlogs").val(),
        6 == this.selectlogsclassid && (this.xian = 1);
        var b = this.getNumberCount % this.pagenum != 0 ? 1 : 0;
        this.pages = this.getNumberCount / this.pagenum + b,
        this.pages = 0 == this.pages ? 1 : this.pages,
        this.pagesOercentage = 100 / this.pages,
        this.showProgressBar(),
        this.SendSoonSelect()
    },
    SendSoonSelect: function() {
        jsonAjax("appindexajax.php", "post", "action=soonselectnumber&post_number_money=" + cgSelect.mNumber + "&post_money=" + cgSelect.mMoney + "&sizixian=" + cgSelect.xian + "&selectlogsclassid=" + cgSelect.selectlogsclassid + "&zjzc=" + cgSelect.zjzc + "&selectnumbertotal_hidden=" + cgSelect.selectnumbertotal_hidden + "&selectlogs=" + cgSelect.selectlogs + "&strarray=" + cgSelect.strarray + "&lujingstat=" + cgSelect.lujingstat, "json", cgSelect.SendSoonSelectFunc)
    },
    SendSoonSelectFunc: function(data) {
        var json = eval(data),
        s = json.s;
        if (s > 9e3) jAlert(data.m + "", "提示框",
        function() {
            cgOrber.logout()
        });
        else if (s > 8e3) jAlert(data.m + "", "提示框",
        function() {});
        else if (cgSelect.pages = cgSelect.pages - 1, 200 == s) cgSelect.credits_use = json.credits_use,
        cgSelect.updateProgressBar(100, "批量发送:" + cgSelect.getNumberCount + "个号码完成！"),
        LeftPintIframe.refresh(),
        jsonAjax("appindexajax.php", "get", "action=soonorder&diyici=1", "json", cgOrber.GetSoonOrder),
        $(".top_kaida li [rel=tab_kuaida]").click(),
        cgSelect.setVal(),
        setTimeout("$.alerts._hide();", 0);
        else if (cgSelect.pages > 0) {
            var getSpNum = parseInt(cgSelect.pagesOercentage * cgSelect.pagesAdd);
            cgSelect.updateProgressBar(getSpNum, "批量发送:" + data.sendtotal + "个号码，正在下注中.."),
            cgSelect.strarray = json.strarray,
            cgSelect.SendPages(cgSelect.pages),
            cgSelect.pagesAdd++
        }
    },
    showProgressBar: function() {
        jProgressBar("", "快选进度条",
        function() {
            var getSpNum = parseInt(cgSelect.pagesOercentage * cgSelect.pagesAdd);
            cgSelect.updateProgressBar(getSpNum, "正在发送号码..")
        })
    },
    updateProgressBar: function(num, title) {
        $(".ProgressBar_t").text(title),
        $(".ProgressBar_w").width(num + "%"),
        $(".ProgressBar_w_s").text(num + "%")
    },
    SendPages: function(p) {
        p > 0 && (cgSelect.mNumber = "", cgSelect.mMoney = 0, cgSelect.selectlogs = "", cgSelect.selectlogsclassid = 0, cgSelect.zjzc = 0, cgSelect.SendSoonSelect())
    },
    __showmeun: function(num) {
        for (var i = 1; i <= 6; i++) $("#han" + i).hide();
        $("#han" + num).show(),
        $("#changyong") && ($("#changyong").hide(), 3 == num && $("#changyong").show()),
        __ss.__classid = num,
        __ss.__shows()
    },
    zhidingweizhi: function(num) {
        setTimeout("$('#selectmoney').select()", 200),
        setTimeout("$('.main_center_select').scrollTop( $('.main_center_select')[0].scrollHeight )", 500)
    },
    loging: function() {
        if ("" != $("#selectnumber").val()) return window.confirm("\n上次生成数据还没有下注完成，确定要重新生成吗?\n\n") ? (__ss.__create(), cgSelect.zhidingweizhi(), cgSelect.mMoney = $("#" + cgSelect.__mID).val() - 0, cgSelect.totalmoney(cgSelect.mMoney), !1) : void 0;
        __ss.__create(),
        cgSelect.zhidingweizhi(),
        cgSelect.mMoney = $("#" + cgSelect.__mID).val() - 0,
        cgSelect.totalmoney(cgSelect.mMoney)
    },
    setVal: function() {
        var _self = this;
        _self.getNumberCount = 0,
        _self.pagenum = 400,
        _self.pages = 1,
        _self.pagesAdd = 1,
        _self.pagesOercentage = 0,
        _self.return_stats = 0,
        _self.strarray = "",
        _self.mNumber = "",
        _self.mMoney = 0,
        _self.selectlogs = "",
        _self.selectlogsclassid = 0,
        _self.zjzc = 0,
        _self.selectnumbertotal_hidden = 0,
        _self.xian = 0,
        $("#selectnumbermoney").html("0"),
        $("#selectnumbertotal").html(""),
        $("#selectnumbertotal_hidden").val("0"),
        $("#selectmoney").val(""),
        $("#selectnumber").val(""),
        $("#selectlogs").val(""),
        $("#showselectnumber").html(this.initHtml()),
        $(".boltsoonselect").hide()
    },
    __reset: function(s) {
        1 == s && jsonAjax("appindexajax.php", "get", "action=selectreset", "json",
        function() {}),
        cgSelect.setVal()
    },
    soonsend: function() {
        $("#selectnumber").val(),
        $("#selectlogs").val(),
        $("#selectlogsclassid").val()
    },
    initHtml: function() {
        for (var html = "",
        i = 1; i <= 7; i++) html += "<tr><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td></tr>";
        return html
    },
    BoltNumber: function(n) {
        var snumber = n.split(","),
        total = snumber.length;
        $("#selectnumbertotal").html(total),
        $("#selectnumbertotal_hidden").val(total),
        $("#selectnumber").val(n),
        $("#showselectnumber").html(this.setHTML(total, snumber)),
        $(".boltsoonselect").show(),
        this.zhidingweizhi()
    },
    setHTML: function(total, snumber) {
        for (var row = Math.floor(total / 8), rownum = total % 8, html = "", idx = 0, i = 0; i < row; i++) html += "<tr><td >" + snumber[idx] + "</td>",
        idx++,
        html += "<td>" + snumber[idx] + "</td>",
        idx++,
        html += "<td>" + snumber[idx] + "</td>",
        idx++,
        html += "<td>" + snumber[idx] + "</td>",
        idx++,
        html += "<td>" + snumber[idx] + "</td>",
        idx++,
        html += "<td>" + snumber[idx] + "</td>",
        idx++,
        html += "<td>" + snumber[idx] + "</td>",
        idx++,
        html += "<td>" + snumber[idx] + "</td>",
        idx++;
        if (rownum > 0) {
            html += "<tr>";
            for (var i = 0; i < rownum; i++) snumber[idx] && (html += "<td>" + snumber[idx] + "</td>", idx++);
            for (i; i < 8; i++) html += "<td>--</td>";
            html += "</tr>"
        }
        return html
    },
    decimal: function(num, v) {
        var vv = Math.pow(10, v);
        return Math.round(num * vv) / vv
    },
    settotalmoney: function(val) {
        var element = document.getElementById("selectmoney");
        element.onkeyup = function() {
            var v = element.value;
            cgSelect.totalmoney(v > 0 ? v: 0)
        }
    },
    totalmoney: function(val) {
        var money = (val - 0) * $("#selectnumbertotal_hidden").val() + "";
        if (money.indexOf(".") != -1) {
            var m = money.split(".");
            money = m[0] + "." + m[1].slice(0, 2),
            money = this.decimal(money, 1)
        }
        $("#selectnumbermoney").html(money),
        cgSelect.credits_use_all = cgCheckSend.FloatAdd(cgSelect.credits_use - 0, money - 0)
    },
    sendstat: !1,
    init: function() {
        __ss.IN_WAPCG = 9,
        $("#selectmoney").limitMoneyX(),
        $("#selectmoney").limitMoneyPoint(),
        cgSelect.settotalmoney(),
        $("#sendsoonselect_but").unbind("click").click(function() {
            0 == cgSelect.sendstat && cgSelect.isChack()
        }),
        $("#selectmoney").keypress(function(event) {
            event.keyCode ? event.keyCode: event.which;
            13 == event.keyCode && $("#sendsoonselect_but").click()
        }),
        $(".menusoonselect").on("click", "td a",
        function() {
            var numbernum = $("#selectnumber").val(),
            selectnumberqiehuan = $("#selectnumberqiehuan").val();
            if ("" != numbernum && 0 == selectnumberqiehuan) {
                if (!window.confirm("\n生成数据还没有下注，确定要切换菜单吗?\n\n")) return ! 1;
                cgSelect.__reset(0)
            }
            $(".menusoonselect").find("tr").children("td").removeClass("active"),
            $(this).parent().addClass("active");
            var activeTab = $(this).attr("rel"),
            Tabarr = activeTab.split("_");
            $("#selectlogsclassid").val(Tabarr[1]),
            $("#zjzc").val(0),
            cgSelect.__showmeun(Tabarr[1])
        }),
        $("#selectForm").submit(function(e) {
            return ! 1
        }),
        $("#selectForm").find("INPUT").keydown(function(event) {
            if (13 == event.keyCode) return $("#setsoonclass1").click(),
            !1
        }),
        cgSelect.setVal()
    }
},
swfobject = function() {
    function f() {
        if (!J) {
            try {
                var Z = j.getElementsByTagName("body")[0].appendChild(C("span"));
                Z.parentNode.removeChild(Z)
            } catch(aa) {
                return
            }
            J = !0;
            for (var X = U.length,
            Y = 0; Y < X; Y++) U[Y]()
        }
    }
    function K(X) {
        J ? X() : U[U.length] = X
    }
    function s(Y) {
        if (typeof O.addEventListener != D) O.addEventListener("load", Y, !1);
        else if (typeof j.addEventListener != D) j.addEventListener("load", Y, !1);
        else if (typeof O.attachEvent != D) i(O, "onload", Y);
        else if ("function" == typeof O.onload) {
            var X = O.onload;
            O.onload = function() {
                X(),
                Y()
            }
        } else O.onload = Y
    }
    function h() {
        T ? V() : H()
    }
    function V() {
        var X = j.getElementsByTagName("body")[0],
        aa = C(r);
        aa.setAttribute("type", q);
        var Z = X.appendChild(aa);
        if (Z) {
            var Y = 0; !
            function() {
                if (typeof Z.GetVariable != D) {
                    var ab = Z.GetVariable("$version");
                    ab && (ab = ab.split(" ")[1].split(","), M.pv = [parseInt(ab[0], 10), parseInt(ab[1], 10), parseInt(ab[2], 10)])
                } else if (Y < 10) return Y++,
                void setTimeout(arguments.callee, 10);
                X.removeChild(aa),
                Z = null,
                H()
            } ()
        } else H()
    }
    function H() {
        var ag = o.length;
        if (ag > 0) for (var af = 0; af < ag; af++) {
            var Y = o[af].id,
            ab = o[af].callbackFn,
            aa = {
                success: !1,
                id: Y
            };
            if (M.pv[0] > 0) {
                var ae = c(Y);
                if (ae) if (!F(o[af].swfVersion) || M.wk && M.wk < 312) if (o[af].expressInstall && A()) {
                    var ai = {};
                    ai.data = o[af].expressInstall,
                    ai.width = ae.getAttribute("width") || "0",
                    ai.height = ae.getAttribute("height") || "0",
                    ae.getAttribute("class") && (ai.styleclass = ae.getAttribute("class")),
                    ae.getAttribute("align") && (ai.align = ae.getAttribute("align"));
                    for (var ah = {},
                    X = ae.getElementsByTagName("param"), ac = X.length, ad = 0; ad < ac; ad++)"movie" != X[ad].getAttribute("name").toLowerCase() && (ah[X[ad].getAttribute("name")] = X[ad].getAttribute("value"));
                    P(ai, ah, Y, ab)
                } else p(ae),
                ab && ab(aa);
                else w(Y, !0),
                ab && (aa.success = !0, aa.ref = z(Y), ab(aa))
            } else if (w(Y, !0), ab) {
                var Z = z(Y);
                Z && typeof Z.SetVariable != D && (aa.success = !0, aa.ref = Z),
                ab(aa)
            }
        }
    }
    function z(aa) {
        var X = null,
        Y = c(aa);
        if (Y && "OBJECT" == Y.nodeName) if (typeof Y.SetVariable != D) X = Y;
        else {
            var Z = Y.getElementsByTagName(r)[0];
            Z && (X = Z)
        }
        return X
    }
    function A() {
        return ! a && F("6.0.65") && (M.win || M.mac) && !(M.wk && M.wk < 312)
    }
    function P(aa, ab, X, Z) {
        a = !0,
        E = Z || null,
        B = {
            success: !1,
            id: X
        };
        var ae = c(X);
        if (ae) {
            "OBJECT" == ae.nodeName ? (l = g(ae), Q = null) : (l = ae, Q = X),
            aa.id = R,
            (typeof aa.width == D || !/%$/.test(aa.width) && parseInt(aa.width, 10) < 310) && (aa.width = "310"),
            (typeof aa.height == D || !/%$/.test(aa.height) && parseInt(aa.height, 10) < 137) && (aa.height = "137"),
            j.title = j.title.slice(0, 47) + " - Flash Player Installation";
            var ad = M.ie && M.win ? "ActiveX": "PlugIn",
            ac = "MMredirectURL=" + O.location.toString().replace(/&/g, "%26") + "&MMplayerType=" + ad + "&MMdoctitle=" + j.title;
            if (typeof ab.flashvars != D ? ab.flashvars += "&" + ac: ab.flashvars = ac, M.ie && M.win && 4 != ae.readyState) {
                var Y = C("div");
                X += "SWFObjectNew",
                Y.setAttribute("id", X),
                ae.parentNode.insertBefore(Y, ae),
                ae.style.display = "none",
                function() {
                    4 == ae.readyState ? ae.parentNode.removeChild(ae) : setTimeout(arguments.callee, 10)
                } ()
            }
            u(aa, ab, X)
        }
    }
    function p(Y) {
        if (M.ie && M.win && 4 != Y.readyState) {
            var X = C("div");
            Y.parentNode.insertBefore(X, Y),
            X.parentNode.replaceChild(g(Y), X),
            Y.style.display = "none",
            function() {
                4 == Y.readyState ? Y.parentNode.removeChild(Y) : setTimeout(arguments.callee, 10)
            } ()
        } else Y.parentNode.replaceChild(g(Y), Y)
    }
    function g(ab) {
        var aa = C("div");
        if (M.win && M.ie) aa.innerHTML = ab.innerHTML;
        else {
            var Y = ab.getElementsByTagName(r)[0];
            if (Y) {
                var ad = Y.childNodes;
                if (ad) for (var X = ad.length,
                Z = 0; Z < X; Z++) 1 == ad[Z].nodeType && "PARAM" == ad[Z].nodeName || 8 == ad[Z].nodeType || aa.appendChild(ad[Z].cloneNode(!0))
            }
        }
        return aa
    }
    function u(ai, ag, Y) {
        var X, aa = c(Y);
        if (M.wk && M.wk < 312) return X;
        if (aa) if (typeof ai.id == D && (ai.id = Y), M.ie && M.win) {
            var ah = "";
            for (var ae in ai) ai[ae] != Object.prototype[ae] && ("data" == ae.toLowerCase() ? ag.movie = ai[ae] : "styleclass" == ae.toLowerCase() ? ah += ' class="' + ai[ae] + '"': "classid" != ae.toLowerCase() && (ah += " " + ae + '="' + ai[ae] + '"'));
            var af = "";
            for (var ad in ag) ag[ad] != Object.prototype[ad] && (af += '<param name="' + ad + '" value="' + ag[ad] + '" />');
            aa.outerHTML = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"' + ah + ">" + af + "</object>",
            N[N.length] = ai.id,
            X = c(ai.id)
        } else {
            var Z = C(r);
            Z.setAttribute("type", q);
            for (var ac in ai) ai[ac] != Object.prototype[ac] && ("styleclass" == ac.toLowerCase() ? Z.setAttribute("class", ai[ac]) : "classid" != ac.toLowerCase() && Z.setAttribute(ac, ai[ac]));
            for (var ab in ag) ag[ab] != Object.prototype[ab] && "movie" != ab.toLowerCase() && e(Z, ab, ag[ab]);
            aa.parentNode.replaceChild(Z, aa),
            X = Z
        }
        return X
    }
    function e(Z, X, Y) {
        var aa = C("param");
        aa.setAttribute("name", X),
        aa.setAttribute("value", Y),
        Z.appendChild(aa)
    }
    function y(Y) {
        var X = c(Y);
        X && "OBJECT" == X.nodeName && (M.ie && M.win ? (X.style.display = "none",
        function() {
            4 == X.readyState ? b(Y) : setTimeout(arguments.callee, 10)
        } ()) : X.parentNode.removeChild(X))
    }
    function b(Z) {
        var Y = c(Z);
        if (Y) {
            for (var X in Y)"function" == typeof Y[X] && (Y[X] = null);
            Y.parentNode.removeChild(Y)
        }
    }
    function c(Z) {
        var X = null;
        try {
            X = j.getElementById(Z)
        } catch(Y) {}
        return X
    }
    function C(X) {
        return j.createElement(X)
    }
    function i(Z, X, Y) {
        Z.attachEvent(X, Y),
        I[I.length] = [Z, X, Y]
    }
    function F(Z) {
        var Y = M.pv,
        X = Z.split(".");
        return X[0] = parseInt(X[0], 10),
        X[1] = parseInt(X[1], 10) || 0,
        X[2] = parseInt(X[2], 10) || 0,
        Y[0] > X[0] || Y[0] == X[0] && Y[1] > X[1] || Y[0] == X[0] && Y[1] == X[1] && Y[2] >= X[2]
    }
    function v(ac, Y, ad, ab) {
        if (!M.ie || !M.mac) {
            var aa = j.getElementsByTagName("head")[0];
            if (aa) {
                var X = ad && "string" == typeof ad ? ad: "screen";
                if (ab && (n = null, G = null), !n || G != X) {
                    var Z = C("style");
                    Z.setAttribute("type", "text/css"),
                    Z.setAttribute("media", X),
                    n = aa.appendChild(Z),
                    M.ie && M.win && typeof j.styleSheets != D && j.styleSheets.length > 0 && (n = j.styleSheets[j.styleSheets.length - 1]),
                    G = X
                }
                M.ie && M.win ? n && typeof n.addRule == r && n.addRule(ac, Y) : n && typeof j.createTextNode != D && n.appendChild(j.createTextNode(ac + " {" + Y + "}"))
            }
        }
    }
    function w(Z, X) {
        if (m) {
            var Y = X ? "visible": "hidden";
            J && c(Z) ? c(Z).style.visibility = Y: v("#" + Z, "visibility:" + Y)
        }
    }
    function L(Y) {
        return null != /[\\\"<>\.;]/.exec(Y) && typeof encodeURIComponent != D ? encodeURIComponent(Y) : Y
    }
    var l, Q, E, B, n, G, D = "undefined",
    r = "object",
    S = "Shockwave Flash",
    q = "application/x-shockwave-flash",
    R = "SWFObjectExprInst",
    x = "onreadystatechange",
    O = window,
    j = document,
    t = navigator,
    T = !1,
    U = [h],
    o = [],
    N = [],
    I = [],
    J = !1,
    a = !1,
    m = !0,
    M = function() {
        var aa = typeof j.getElementById != D && typeof j.getElementsByTagName != D && typeof j.createElement != D,
        ah = t.userAgent.toLowerCase(),
        Y = t.platform.toLowerCase(),
        ae = Y ? /win/.test(Y) : /win/.test(ah),
        ac = Y ? /mac/.test(Y) : /mac/.test(ah),
        af = !!/webkit/.test(ah) && parseFloat(ah.replace(/^.*webkit\/(\d+(\.\d+)?).*$/, "$1")),
        X = !1,
        ag = [0, 0, 0],
        ab = null;
        if (typeof t.plugins != D && typeof t.plugins[S] == r) ab = t.plugins[S].description,
        !ab || typeof t.mimeTypes != D && t.mimeTypes[q] && !t.mimeTypes[q].enabledPlugin || (T = !0, X = !1, ab = ab.replace(/^.*\s+(\S+\s+\S+$)/, "$1"), ag[0] = parseInt(ab.replace(/^(.*)\..*$/, "$1"), 10), ag[1] = parseInt(ab.replace(/^.*\.(.*)\s.*$/, "$1"), 10), ag[2] = /[a-zA-Z]/.test(ab) ? parseInt(ab.replace(/^.*[a-zA-Z]+(.*)$/, "$1"), 10) : 0);
        else if (typeof O.ActiveXObject != D) try {
            var ad = new ActiveXObject("ShockwaveFlash.ShockwaveFlash");
            ad && (ab = ad.GetVariable("$version"), ab && (X = !0, ab = ab.split(" ")[1].split(","), ag = [parseInt(ab[0], 10), parseInt(ab[1], 10), parseInt(ab[2], 10)]))
        } catch(Z) {}
        return {
            w3: aa,
            pv: ag,
            wk: af,
            ie: X,
            win: ae,
            mac: ac
        }
    } (); (function() {
        M.w3 && ((typeof j.readyState != D && "complete" == j.readyState || typeof j.readyState == D && (j.getElementsByTagName("body")[0] || j.body)) && f(), J || (typeof j.addEventListener != D && j.addEventListener("DOMContentLoaded", f, !1), M.ie && M.win && (j.attachEvent(x,
        function() {
            "complete" == j.readyState && (j.detachEvent(x, arguments.callee), f())
        }), O == top &&
        function() {
            if (!J) {
                try {
                    j.documentElement.doScroll("left")
                } catch(X) {
                    return void setTimeout(arguments.callee, 0)
                }
                f()
            }
        } ()), M.wk &&
        function() {
            if (!J) return /loaded|complete/.test(j.readyState) ? void f() : void setTimeout(arguments.callee, 0)
        } (), s(f)))
    })(),
    function() {
        M.ie && M.win && window.attachEvent("onunload",
        function() {
            for (var ac = I.length,
            ab = 0; ab < ac; ab++) I[ab][0].detachEvent(I[ab][1], I[ab][2]);
            for (var Z = N.length,
            aa = 0; aa < Z; aa++) y(N[aa]);
            for (var Y in M) M[Y] = null;
            M = null;
            for (var X in swfobject) swfobject[X] = null;
            swfobject = null
        })
    } ();
    return {
        registerObject: function(ab, X, aa, Z) {
            if (M.w3 && ab && X) {
                var Y = {};
                Y.id = ab,
                Y.swfVersion = X,
                Y.expressInstall = aa,
                Y.callbackFn = Z,
                o[o.length] = Y,
                w(ab, !1)
            } else Z && Z({
                success: !1,
                id: ab
            })
        },
        getObjectById: function(X) {
            if (M.w3) return z(X)
        },
        embedSWF: function(ab, ah, ae, ag, Y, aa, Z, ad, af, ac) {
            var X = {
                success: !1,
                id: ah
            };
            M.w3 && !(M.wk && M.wk < 312) && ab && ah && ae && ag && Y ? (w(ah, !1), K(function() {
                ae += "",
                ag += "";
                var aj = {};
                if (af && typeof af === r) for (var al in af) aj[al] = af[al];
                aj.data = ab,
                aj.width = ae,
                aj.height = ag;
                var am = {};
                if (ad && typeof ad === r) for (var ak in ad) am[ak] = ad[ak];
                if (Z && typeof Z === r) for (var ai in Z) typeof am.flashvars != D ? am.flashvars += "&" + ai + "=" + Z[ai] : am.flashvars = ai + "=" + Z[ai];
                if (F(Y)) {
                    var an = u(aj, am, ah);
                    aj.id == ah && w(ah, !0),
                    X.success = !0,
                    X.ref = an
                } else {
                    if (aa && A()) return aj.data = aa,
                    void P(aj, am, ah, ac);
                    w(ah, !0)
                }
                ac && ac(X)
            })) : ac && ac(X)
        },
        switchOffAutoHideShow: function() {
            m = !1
        },
        ua: M,
        getFlashPlayerVersion: function() {
            return {
                major: M.pv[0],
                minor: M.pv[1],
                release: M.pv[2]
            }
        },
        hasFlashPlayerVersion: F,
        createSWF: function(Z, Y, X) {
            return M.w3 ? u(Z, Y, X) : void 0
        },
        showExpressInstall: function(Z, aa, X, Y) {
            M.w3 && A() && P(Z, aa, X, Y)
        },
        removeSWF: function(X) {
            M.w3 && y(X)
        },
        createCSS: function(aa, Z, Y, X) {
            M.w3 && v(aa, Z, Y, X)
        },
        addDomLoadEvent: K,
        addLoadEvent: s,
        getQueryParamValue: function(aa) {
            var Z = j.location.search || j.location.hash;
            if (Z) {
                if (/\?/.test(Z) && (Z = Z.split("?")[1]), null == aa) return L(Z);
                for (var Y = Z.split("&"), X = 0; X < Y.length; X++) if (Y[X].substring(0, Y[X].indexOf("=")) == aa) return L(Y[X].substring(Y[X].indexOf("=") + 1))
            }
            return ""
        },
        expressInstallCallback: function() {
            if (a) {
                var X = c(R);
                X && l && (X.parentNode.replaceChild(l, X), Q && (w(Q, !0), M.ie && M.win && (l.style.display = "block")), E && E(B)),
                a = !1
            }
        }
    }
} (),
_systemTime = 0,
_openstart = 0,
_sellBegTime = 0,
_sellEndTime = 0;
isIE6 || swfobject.embedSWF("./admincg/images/chatimg/sound.swf", "sound", "1", "1", "6.0.0", "./admincg/images/chatimg/expressInstall.swf", {
    name1: "hello",
    name2: "world",
    name3: "foobar"
},
{
    menu: "false",
    wmode: "transparent"
},
{
    id: "sound",
    name: "sound"
}),
_systemTime = Math.floor(_systemTime) > 0 ? _systemTime: 0;
var loadnow = new Date,
cracktime = _systemTime - Math.floor(loadnow.getTime() / 1e3),
upSec = 0; !
function($) {
    var opt;
    $.fn.jqprint = function(options) {
        opt = $.extend({},
        $.fn.jqprint.defaults, options);
        var $element = this instanceof jQuery ? this: $(this);
        if (opt.operaSupport && $.support.opera) {
            var tab = window.open("", "jqPrint-preview");
            tab.document.open();
            var doc = tab.document
        } else {
            var $iframe = $("<iframe  />");
            opt.debug || $iframe.css({
                position: "absolute",
                width: "0px",
                height: "0px",
                left: "-600px",
                top: "-600px",
                margin: "0",
                padding: "0"
            }),
            $iframe.appendTo("body");
            var doc = $iframe[0].contentWindow.document
        }
        opt.importCSS && ($("link[media=print]").length > 0 ? $("link[media=print]").each(function() {
            doc.write("<link type='text/css' rel='stylesheet' href='" + $(this).attr("href") + "' media='print' />")
        }) : $("link").each(function() {
            doc.write("<link type='text/css' rel='stylesheet' href='" + $(this).attr("href") + "' />")
        })),
        opt.printContainer ? doc.write($element.outer()) : $element.each(function() {
            doc.write($(this).html())
        }),
        $iframe.contents().find("body").css("margin", 0),
        doc.close();
        var mozilla = /firefox/.test(navigator.userAgent.toLowerCase()); (opt.operaSupport && $.support.opera ? tab: $iframe[0].contentWindow).focus(),
        setTimeout(function() {
            var objprint = opt.operaSupport && $.support.opera ? tab: $iframe[0].contentWindow;
            mozilla ? objprint.print() : objprint.document.execCommand("print", !1, null),
            $iframe ? $iframe.remove() : tab && tab.close()
        },
        1e3)
    },
    $.fn.jqprint.defaults = {
        debug: !1,
        importCSS: !0,
        printContainer: !0,
        operaSupport: !0
    },
    jQuery.fn.outer = function() {
        return $($("<div></div>").html(this.clone())).html()
    }
} (jQuery);
var __ss = {
    IN_WAPCG: 0,
    __selectnumbertotal: 0,
    __selectnumber: [],
    __fuhao: "X",
    __classid: 0,
    __setchecked: function(n) {
        return $ss(n).checked ? 1 : 0
    },
    __setselectlogs: function() {
        var str = "";
        if ("none" != $ss("s3").style.display) {
            str += this.__setchecked("__dingwei_chu") + ",",
            str += this.__setchecked("__dingwei_qu") + ",";
            for (var i = 1; i <= 4; i++) str += $ss("__dingwei_" + i).value + ","
        }
        if (str += "|", "none" != $ss("s5").style.display) {
            str += this.__setchecked("__hefen_chu") + ",",
            str += this.__setchecked("__hefen_qu") + ",";
            for (var i = 1; i <= 4; i++) str += this.__setchecked("__hefenzhide_w_1" + i) + ",",
            str += this.__setchecked("__hefenzhide_w_2" + i) + ",",
            str += this.__setchecked("__hefenzhide_w_3" + i) + ",",
            str += this.__setchecked("__hefenzhide_w_4" + i) + ",",
            str += $ss("__hefenzhide_" + i).value + ","
        }
        if (str += "|", "none" != $ss("s6").style.display && (str += this.__setchecked("__bdwhefen_1") + ",", str += (1 == this.__classid || 4 == this.__classid ? 0 : this.__setchecked("__bdwhefen_2")) + ",", str += $ss("__bdwhefen").value + ","), str += "|", "none" != $ss("zfw1").style.display && 3 == this.__classid && (str += $ss("__zhifanwei_start").value + ",", str += $ss("__zhifanwei_end").value + ","), str += "|", this.__classid <= 3 && ("none" != $ss("quandao").style.display && (str += $ss("__quandao").value + ","), "none" != $ss("shangjiang").style.display && (str += $ss("__shangjiang").value + ","), "none" != $ss("paichu").style.display && (str += $ss("__paichu").value + ",")), str += "|", this.__classid <= 2 && "none" != $ss("ch1").style.display) for (var i = 1; i <= 4; i++) str += this.__setchecked("__chenghao_" + i) + ",";
        str += "|",
        "none" != $ss("han" + this.__classid).style.display && (str += this.__setchecked("__chu_" + this.__classid) + ",", str += this.__setchecked("__qu_" + this.__classid) + ",", str += $ss("__han_" + this.__classid).value + ",", str += $ss("__fushi_" + this.__classid).value + ","),
        str += "|";
        for (var i = 1; i <= 4; i++)"none" != $ss("s8").style.display && "none" != $ss("ss" + i).style.display && (str += this.__setchecked("__chu_chong_" + i) + ",", str += this.__setchecked("__qu_chong_" + i) + ","),
        str += "|";
        i = 0;
        for (var j = 5; j <= 7; j++) i++,
        "none" != $ss("s9").style.display && "none" != $ss("ss" + j).style.display && (str += this.__setchecked("__chu_xiongdi_" + i) + ",", str += this.__setchecked("__qu_xiongdi_" + i) + ","),
        str += "|";
        if ("none" != $ss("s10").style.display && (str += this.__setchecked("__chu_duishu") + ",", str += this.__setchecked("__qu_duishu") + ",", str += $ss("__duishu_1").value + ",", str += $ss("__duishu_2").value + ",", str += $ss("__duishu_3").value + ","), str += "|", "none" != $ss("dan1").style.display) {
            str += this.__setchecked("__dan_chu") + ",",
            str += this.__setchecked("__dan_qu") + ",";
            for (var i = 1; i <= 4; i++) 4 == this.__classid && i <= 2 || 5 == this.__classid && i <= 1 || (str += this.__setchecked("__dan_" + i) + ",")
        }
        if (str += "|", "none" != $ss("shuang1").style.display) {
            str += this.__setchecked("__shuang_chu") + ",",
            str += this.__setchecked("__shuang_qu") + ",";
            for (var i = 1; i <= 4; i++) 4 == this.__classid && i <= 2 || 5 == this.__classid && i <= 1 || (str += this.__setchecked("__shuang_" + i) + ",")
        }
        return str += "|",
        "none" != $ss("s12").style.display && (this.__classid > 3 ? (str += this.__setchecked("__peishu_chu2") + ",", str += this.__setchecked("__peishu_qu2") + ",") : (str += this.__setchecked("__peishu_chu") + ",", str += this.__setchecked("__peishu_qu") + ","), str += $ss("__peishu_1").value + ",", str += $ss("__peishu_2").value + ",", str += $ss("__peishu_3").value + ",", str += $ss("__peishu_4").value + ",", str += this.__setchecked("__gd1") + ",", str += this.__setchecked("__gd2") + ",", str += this.__setchecked("__gd3") + ",", str += this.__setchecked("__gd4") + ","),
        str += "|",
        3 == this.__classid && $ss("__changyong").checked && (str += this.__setchecked("__changyong") + ","),
        str += "|"
    },
    __showmeun: function(num) {
        for (var i = 1; i <= 6; i++) $ss("han" + i).style.display = "none",
        0 == _soonset.sidingwei && 3 == i || ($ss("soonclass" + i).disabled = !1, $ss("soonclass" + i).className = "select_button2 number_count number_w3");
        $ss("soonclass" + num).disabled = !0,
        $ss("han" + num).style.display = "",
        $ss("changyong") && ($ss("changyong").style.display = "none", 3 == num && ($ss("changyong").style.display = "")),
        $ss("soonclass" + num).className = "select_button1 number_count number_w3",
        this.__classid = num,
        this.__shows()
    },
    __shows: function() {
        for (var i = 1; i <= 11; i++) 2 == i || 3 == i ? ($ss("__dingwei_qu").checked || $ss("__dingwei_chu").checked) && ($ss("s" + i).style.display = "") : $ss("s" + i).style.display = "";
        if (1 != this.IN_WAPCG && 2 != this.IN_WAPCG || ($ss("s14").style.display = "none"), $ss("__peishu_qu").checked || $ss("__peishu_chu").checked || $ss("__peishu_qu2").checked || $ss("__peishu_chu2").checked || this.__classid > 3) {
            for (var i = 1; i <= 4; i++) $ss("ps" + i).style.display = "",
            $ss("__peishu_" + i).value = "";
            $ss("__peishu_qu").checked ? ($ss("__peishu_qu2").checked = !0, $ss("__peishu_chu2").checked = !1) : $ss("__peishu_chu").checked && ($ss("__peishu_chu2").checked = !0, $ss("__peishu_qu2").checked = !1)
        }
        $ss("psgdstr").style.display = "none",
        ($ss("__dingwei_qu").checked || $ss("__dingwei_chu").checked) && ($ss("s12").style.display = "none"),
        this.__classid > 3 && ($ss("__peishu_qu2").checked || $ss("__peishu_chu2").checked) && ($ss("s12").style.display = ""),
        3 != this.__classid ? $ss("psgdstr").style.display = "none": 3 == this.__classid && ($ss("__peishu_qu").checked || $ss("__peishu_chu").checked) && ($ss("psgdstr").style.display = ""),
        $ss("s13").style.display = "";
        for (var i = 1; i <= 10; i++) $ss("ss" + i).style.display = "";
        for (var i = 1; i <= 2; i++) $ss("bd" + i).style.display = "",
        $ss("ch" + i).style.display = "";
        for (var i = 1; i <= 4; i++) $ss("dsd" + i).style.display = "",
        $ss("dss" + i).style.display = "";
        if (2 == this.IN_WAPCG || 9 == this.IN_WAPCG || (1 == this.IN_WAPCG ? window.parent.frames.soonselectorder.document.getElementById("sizixian") && setTimeout('window.parent.frames["soonselectorder"].$("sizixian").checked=false;', 200) : window.parent.parent.frames.main.frames.soonselectorder.document.getElementById("sizixian") && setTimeout('window.parent.parent.frames["main"].frames["soonselectorder"].$("sizixian").checked=false;', 200)), $ss("zfw1").style.display = "", 1 == this.__classid) $ss("ss2").style.display = "none",
        $ss("ss3").style.display = "none",
        $ss("ss6").style.display = "none",
        $ss("ss4").style.display = "none",
        $ss("ss7").style.display = "none",
        $ss("bd2").style.display = "none",
        $ss("zfw1").style.display = "none",
        $ss("ps3").style.display = "none",
        $ss("ps4").style.display = "none",
        $ss("s13").style.display = "none",
        1 != this.IN_WAPCG && 2 != this.IN_WAPCG || ($ss("s14").style.display = "");
        else if (2 == this.__classid) $ss("ss2").style.display = "none",
        $ss("ss4").style.display = "none",
        $ss("ss7").style.display = "none",
        $ss("zfw1").style.display = "none",
        $ss("ps4").style.display = "none",
        $ss("s13").style.display = "none",
        1 != this.IN_WAPCG && 2 != this.IN_WAPCG || ($ss("s14").style.display = "");
        else if (3 == this.__classid) $ss("ch1").style.display = "none",
        $ss("ch2").style.display = "none",
        $ss("s13").style.display = "none",
        1 != this.IN_WAPCG && 2 != this.IN_WAPCG || ($ss("__peishu_qu").checked || $ss("__peishu_chu").checked) && ($ss("s14").style.display = "");
        else if (4 == this.__classid) {
            for (var i = 1; i <= 11; i++) 6 != i && 8 != i && 9 != i && 10 != i && 11 != i && ($ss("s" + i).style.display = "none");
            for (var i = 2; i <= 7; i++) 5 != i && ($ss("ss" + i).style.display = "none");
            $ss("zfw1").style.display = "none",
            $ss("bd2").style.display = "none";
            for (var i = 1; i <= 2; i++) $ss("dsd" + i).style.display = "none",
            $ss("dss" + i).style.display = "none";
            $ss("ps3").style.display = "none",
            $ss("ps4").style.display = "none"
        } else if (5 == this.__classid || 6 == this.__classid) {
            for (var i = 1; i <= 11; i++) 6 != i && 8 != i && 9 != i && 10 != i && 11 != i && ($ss("s" + i).style.display = "none");
            for (var i = 2; i <= 7; i++) 3 != i && 5 != i && 6 != i && ($ss("ss" + i).style.display = "none");
            if ($ss("zfw1").style.display = "none", 6 == this.__classid) $ss("ss4").style.display = "",
            $ss("ss7").style.display = "",
            2 == this.IN_WAPCG || 9 == this.IN_WAPCG || (1 == this.IN_WAPCG ? window.parent.frames.soonselectorder.document.getElementById("sizixian") && setTimeout('window.parent.frames["soonselectorder"].document.getElementById("sizixian").checked=true;', 200) : window.parent.parent.frames.main.frames.soonselectorder.document.getElementById("sizixian") && setTimeout('window.parent.parent.frames["main"].frames["soonselectorder"].$("sizixian").checked=true;\t', 200));
            else for (var i = 1; i <= 1; i++) $ss("dsd" + i).style.display = "none",
            $ss("dss" + i).style.display = "none"
        }
        5 == this.__classid && ($ss("ps4").style.display = "none");
        var stat = 0,
        s_1 = 0,
        s_2 = 0;
        for (var i in _soonset) if (stat = _soonset[i], 0 == stat) {
            if ("s_weizhi" == i) for (var i = 1; i <= 3; i++) $ss("s" + i).style.display = "none";
            else if ("s_hefen" == i) for (var i = 4; i <= 5; i++) $ss("s" + i).style.display = "none";
            else if ("s_bdwhefen" == i) $ss("bdwhefen1").style.display = "none",
            s_1++;
            else if ("zhifenwei" == i) $ss("zfw1").style.display = "none",
            s_1++;
            else if ("quandao" == i) $ss("quandao").style.display = "none",
            s_2++;
            else if ("paichu" == i) $ss("paichu").style.display = "none",
            s_2++;
            else if ("chenghao" == i) {
                for (var i = 1; i <= 2; i++) $ss("ch" + i).style.display = "none";
                s_2++
            } else if ("fushi" == i) for (var i = 1; i <= 5; i++) $ss("han" + i).style.display = "none";
            else "shong1" == i ? $ss("ss1").style.display = "none": "shong2" == i ? $ss("ss2").style.display = "none": "shong3" == i ? $ss("ss3").style.display = "none": "shong4" == i ? $ss("ss4").style.display = "none": "xiongdi1" == i ? $ss("ss5").style.display = "none": "xiongdi2" == i ? $ss("ss6").style.display = "none": "xiongdi3" == i ? $ss("ss7").style.display = "none": "duishu" == i ? $ss("s10").style.display = "none": "dan" == i ? $ss("dan1").style.display = "none": "shuang" == i ? $ss("shuang1").style.display = "none": "shangjiang" == i && ($ss("shangjiang").style.display = "none");
            2 == s_1 && ($ss("s6").style.display = "none"),
            3 == s_2 && ($ss("s7").style.display = "none", 1 != this.IN_WAPCG && 2 != this.IN_WAPCG || ($ss("s14").style.display = "none"))
        }
        $ss("__quandao").value = "",
        $ss("__shangjiang").value = "",
        $ss("__paichu").value = "";
        for (var i = 1; i <= 4; i++) $ss("__chenghao_" + i).checked = !1;
        setTimeout("__ss.__danshuangshow();", 300),
        __ss.__danshuangset(1),
        __ss.__danshuangset(2)
    },
    __isempty: function() {
        if (3 == this.__classid && $ss("__changyong").checked) return 0;
        for (var i = 1; i <= 4; i++) {
            var returnv = 1;
            if (this.__classid <= 3) {
                if ("" != $ss("__dingwei_" + i).value) {
                    returnv = 0;
                    break
                }
                if (1 == returnv && "" != $ss("__hefenzhide_" + i).value) {
                    returnv = 0;
                    break
                }
            }
            if (1 == returnv && this.__classid <= 3 && $ss("__chenghao_" + i).checked) {
                returnv = 0;
                break
            }
            if (1 == returnv && ($ss("__dan_" + i).checked || $ss("__shuang_" + i).checked)) {
                returnv = 0;
                break
            }
        }
        if (1 == returnv && "" != $ss("__bdwhefen").value && (returnv = 0), 1 == returnv && this.__classid <= 3 && ("" == $ss("__quandao").value && "" == $ss("__shangjiang").value && "" == $ss("__paichu").value || (returnv = 0)), 1 == returnv && ("" != $ss("__han_" + this.__classid).value && (returnv = 0), "" != $ss("__fushi_" + this.__classid).value && (returnv = 0), 1 == returnv && $ss("__chu_" + this.__classid).checked && (returnv = 0), 1 == returnv && $ss("__qu_" + this.__classid).checked && (returnv = 0)), 1 == returnv) {
            var ii = 4;
            for (1 != this.__classid && 4 != this.__classid || (ii = 1), 2 != this.__classid && 5 != this.__classid || (ii = 3), 3 != this.__classid && 6 != this.__classid || (ii = 4), i = 1; i <= ii; i++) if ($ss("__chu_chong_" + i).checked || $ss("__qu_chong_" + i).checked) {
                returnv = 0;
                break
            }
        }
        if (1 == returnv) {
            var ii = 3;
            for (1 != this.__classid && 4 != this.__classid || (ii = 1), 2 != this.__classid && 5 != this.__classid || (ii = 2), 3 != this.__classid && 6 != this.__classid || (ii = 3), i = 1; i <= ii; i++) if ($ss("__qu_xiongdi_" + i).checked || $ss("__chu_xiongdi_" + i).checked) {
                returnv = 0;
                break
            }
        }
        return 1 == returnv && ("" == $ss("__duishu_1").value && "" == $ss("__duishu_2").value && "" == $ss("__duishu_3").value || (returnv = 0)),
        1 == returnv && ("" == $ss("__zhifanwei_start").value && "" == $ss("__zhifanwei_end").value || (returnv = 0)),
        1 == returnv && $ss("__chu_duishu").checked && (returnv = 0),
        1 == returnv && $ss("__qu_duishu").checked && (returnv = 0),
        1 == returnv && (1 == this.__classid || 4 == this.__classid ? ("" != $ss("__peishu_1").value && (returnv = 0), "" != $ss("__peishu_2").value && (returnv = 0)) : 2 == this.__classid || 5 == this.__classid ? ("" != $ss("__peishu_1").value && (returnv = 0), "" != $ss("__peishu_2").value && (returnv = 0), "" != $ss("__peishu_3").value && (returnv = 0)) : 3 != this.__classid && 6 != this.__classid || ("" != $ss("__peishu_1").value && (returnv = 0), "" != $ss("__peishu_2").value && (returnv = 0), "" != $ss("__peishu_3").value && (returnv = 0), "" != $ss("__peishu_4").value && (returnv = 0))),
        returnv
    },
    __numberdata: [],
    __dingweizhi_data: function(num) {
        var returnv = "-1";
        return 1 != this.__classid && 2 != this.__classid || 1 != this.__chenghaoarray[num] ? 4 == this.__classid && num < 2 ? returnv = "0": 5 == this.__classid && 0 == num && (returnv = "0") : returnv = "0",
        returnv
    },
    __result: "",
    __dingweizhi: function() {
        new Date;
        if (this.__guding_array = [], this.__int_dingwei_num(), this.__changyong()) return this.__result;
        if (this.__set_peishu()) return this.__result;
        if (this.__return_quandao()) return this.__result;
        this.__selectnumbertotal = 0;
        var val, classdingwei, numberstr, data = [],
        allnum = 0;
        for (i = 0; i < this.__dingweiarray.length; i++)"" != this.__dingweiarray[i] && allnum++,
        val = this.__dingweiarray[i] ? this.__dingweiarray[i] : parseInt(this.__dingweiarray[i], 10),
        data[i] = "0123456789",
        data[i] = this.__dingwei_chu || this.__henfushi_chu ? data[i] : new RegExp(val).test(data[i]) ? "" + val: data[i],
        "" != this.__fushi && (data[i] = this.__henfushi_chu ? data[i] : this.__fushi),
        classdingwei = this.__dingweizhi_data(i),
        "-1" != classdingwei && (val >= 0 ? d = "": data[i] = classdingwei),
        data[i] = data[i].split("");
        if (1 == this.__classid && allnum >= 3) return this.__result = "";
        if (2 == this.__classid && allnum >= 4) return this.__result = "";
        if (this.__check_er_san_all_dingwei()) return this.__result;
        for (var nnnn = 0,
        a = 0; a < data[0].length; a++) for (var b = 0; b < data[1].length; b++) for (var c = 0; c < data[2].length; c++) for (var d = 0; d < data[3].length; d++) {
            if (this.__numberdata[0] = data[0][a], this.__numberdata[1] = data[1][b], this.__numberdata[2] = data[2][c], this.__numberdata[3] = data[3][d], data[0][a] + data[1][b] + data[2][c] + data[3][d], 6 == this.__classid) {
                if (this.__numberdata[0] > this.__numberdata[1]) continue;
                if (this.__numberdata[1] > this.__numberdata[2]) continue;
                if (this.__numberdata[2] > this.__numberdata[3]) continue
            } else if (5 == this.__classid) {
                if (this.__numberdata[0] = "", this.__numberdata[1] > this.__numberdata[2]) continue;
                if (this.__numberdata[2] > this.__numberdata[3]) continue
            } else if (4 == this.__classid && (this.__numberdata[0] = "", this.__numberdata[1] = "", this.__numberdata[2] > this.__numberdata[3])) continue;
            this.__check_sanziding() && this.__check_hefen() && this.__check_zhifanwei() && this.__check_hanfushi() && this.__check_chong() && (numberstr = this.__numberdata[0] + this.__numberdata[1] + this.__numberdata[2] + this.__numberdata[3], this.__check_dingwei_reg(numberstr) && this.__check_dan_reg(numberstr) && this.__check_xiongdi_reg(numberstr) && this.__check_duishu_reg(numberstr) && this.__check_paichu_reg(numberstr) && this.__check__bdwhefen_reg(numberstr) && this.__check_hanfushi_reg(numberstr) && (this.__result += this.__number_html(numberstr), this.__selectnumber[this.__selectnumbertotal] = numberstr, this.__selectnumbertotal++)),
            nnnn++
        }
        new Date;
        return this.__result
    },
    __number_html: function(numberstr) {
        return "<li>" + numberstr + "</li>"
    },
    __check_quandao: function(str) {
        if (str.length < 2) return new Array(str);
        if (2 == str.length) {
            var newArray = new Array;
            return newArray[0] = str.charAt(0) + str.charAt(1),
            newArray[1] = str.charAt(1) + str.charAt(0),
            newArray
        }
        for (var Char = str.charAt(0), str = str.slice(1), arr = this.__check_quandao(str), newArray = new Array, i = 0; i < arr.length; i++) for (var j = 0; j <= arr[i].length; j++) {
            var sliceStr = arr[i];
            sliceStr = sliceStr.slice(0, j) + Char + sliceStr.slice(j),
            newArray[i * (arr[i].length + 1) + j] = sliceStr
        }
        return newArray
    },
    __set_unique: function(arr) {
        for (var elem, result = [], hash = {},
        i = 0; null != (elem = arr[i]); i++) hash[elem] || (result.push(elem), hash[elem] = !0);
        return result
    },
    __set_peishuchuarr: function() {
        var pschuarr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
        pschu = [],
        n = 0;
        if (3 == this.__classid && "" != this.__arr_guding) for (i1 = 0; i1 < 10; i1++) for (i2 = 0; i2 < 10; i2++) for (i3 = 0; i3 < 10; i3++) for (i4 = 0; i4 < 10; i4++) pschu[n] = pschuarr[i1] + "" + pschuarr[i2] + pschuarr[i3] + pschuarr[i4],
        n++;
        else if (1 == this.__classid || 4 == this.__classid) for (i1 = 0; i1 < 10; i1++) for (i2 = i1; i2 < 10; i2++) pschu[n] = pschuarr[i1] + "" + pschuarr[i2],
        n++;
        else if (2 == this.__classid || 5 == this.__classid) for (i1 = 0; i1 < 10; i1++) for (i2 = i1; i2 < 10; i2++) for (i3 = i2; i3 < 10; i3++) pschu[n] = pschuarr[i1] + "" + pschuarr[i2] + pschuarr[i3],
        n++;
        else if (3 == this.__classid || 6 == this.__classid) for (i1 = 0; i1 < 10; i1++) for (i2 = i1; i2 < 10; i2++) for (i3 = i2; i3 < 10; i3++) for (i4 = i3; i4 < 10; i4++) pschu[n] = pschuarr[i1] + "" + pschuarr[i2] + pschuarr[i3] + pschuarr[i4],
        n++;
        return pschu
    },
    __set_trim: function(s) {
        return s = s.replace(/\s/g, ""),
        s.replace(/(^\s*)|(\s*$)/g, "")
    },
    __set_peishu: function() {
        this.__peishu = [];
        var psmorenarr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        if (0 == $ss("__peishu_qu").checked && 0 == $ss("__peishu_chu").checked && 0 == $ss("__peishu_qu2").checked && 0 == $ss("__peishu_chu2").checked) return 0;
        this.__get_peishu_guding();
        var ps1 = $ss("__peishu_1").value,
        ps2 = $ss("__peishu_2").value,
        ps3 = $ss("__peishu_3").value,
        ps4 = $ss("__peishu_4").value;
        ps1 = this.__set_trim(ps1),
        ps2 = this.__set_trim(ps2),
        ps3 = this.__set_trim(ps3),
        ps4 = this.__set_trim(ps4);
        var num = 0,
        n_arr = ps1arr = ps2arr = ps3arr = ps4arr = [];
        "" != ps1 && (ps1arr = ps1.split("")),
        "" != ps2 && (ps2arr = ps2.split("")),
        "" != ps3 && (ps3arr = ps3.split("")),
        "" != ps4 && (ps4arr = ps4.split(""));
        var guding = [];
        if (1 == this.__classid || 4 == this.__classid) {
            if ("" != ps1arr && "" == ps2arr ? ps2arr = psmorenarr: "" == ps1arr && "" != ps2arr && (ps1arr = psmorenarr), "" != ps1arr && "" != ps2arr) for (i1 in ps1arr) for (i2 in ps2arr) n_arr[num] = ps1arr[i1] + "" + ps2arr[i2],
            n_arr[num] = this.__str_sort(n_arr[num]),
            num++
        } else if (2 == this.__classid || 5 == this.__classid) {
            if ("" == ps1arr && "" == ps2arr && "" == ps3arr || (ps1arr = "" != ps1arr ? ps1arr: psmorenarr, ps2arr = "" != ps2arr ? ps2arr: psmorenarr, ps3arr = "" != ps3arr ? ps3arr: psmorenarr), "" != ps1arr && "" != ps2arr && "" != ps3arr) for (i1 in ps1arr) for (i2 in ps2arr) for (i3 in ps3arr) n_arr[num] = ps1arr[i1] + "" + ps2arr[i2] + ps3arr[i3],
            n_arr[num] = this.__str_sort(n_arr[num]),
            num++
        } else if ((3 == this.__classid || 6 == this.__classid) && ("" == ps1arr && "" == ps2arr && "" == ps3arr && "" == ps4arr || (ps1arr = "" != ps1arr ? ps1arr: psmorenarr, ps2arr = "" != ps2arr ? ps2arr: psmorenarr, ps3arr = "" != ps3arr ? ps3arr: psmorenarr, ps4arr = "" != ps4arr ? ps4arr: psmorenarr), "" != ps1arr && "" != ps2arr && "" != ps3arr && "" != ps4arr)) for (i1 in ps1arr) for (i2 in ps2arr) for (i3 in ps3arr) for (i4 in ps4arr)"" != this.__arr_guding ? (n_arr[num] = [], n_arr[num][0] = $ss("__gd1").checked ? "x": ps1arr[i1], n_arr[num][1] = $ss("__gd2").checked ? "x": ps2arr[i2], n_arr[num][2] = $ss("__gd3").checked ? "x": ps3arr[i3], n_arr[num][3] = $ss("__gd4").checked ? "x": ps4arr[i4], guding = n_arr) : (n_arr[num] = ps1arr[i1] + "" + ps2arr[i2] + ps3arr[i3] + ps4arr[i4], n_arr[num] = this.__str_sort(n_arr[num])),
        num++;
        var getnumber = !1;
        if ("" != n_arr) {
            var set_arr = [];
            if (3 == this.__classid && "" != this.__arr_guding ? (guding = this.__set_unique(guding), n_arr = this.__get_peishu_number(guding), n_arr = this.__set_unique(n_arr)) : n_arr = this.__set_unique(n_arr), $ss("__peishu_chu").checked || $ss("__peishu_chu2").checked) {
                var n = 0,
                pschu = [];
                pschu = this.__set_peishuchuarr();
                for (i in pschu) n_arr.toString().indexOf(pschu[i]) == -1 && (set_arr[n] = pschu[i], n++)
            } else set_arr = n_arr;
            if (3 == this.__classid && "" != this.__arr_guding) this.__guding_array = set_arr,
            getnumber = this.__return_quandao();
            else if (this.__classid > 3) {
                for (i in set_arr) numberstr = set_arr[i],
                numarr = numberstr.split(""),
                this.__numberdata[0] = numarr[0],
                this.__numberdata[1] = numarr[1],
                this.__numberdata[2] = numarr[2] ? numarr[2] : "",
                this.__numberdata[3] = numarr[3] ? numarr[3] : "",
                this.__check_hefen() && this.__check_zhifanwei() && this.__check_hanfushi() && this.__check_chong() && this.__check_dan_reg(numberstr) && this.__check_xiongdi_reg(numberstr) && this.__check_duishu_reg(numberstr) && this.__check_dingwei_reg(numberstr) && this.__check_paichu_reg(numberstr) && this.__check__bdwhefen_reg(numberstr) && this.__check_hanfushi_reg(numberstr) && (this.__result += this.__number_html(numberstr), this.__selectnumber[this.__selectnumbertotal] = numberstr, this.__selectnumbertotal++);
                getnumber = !0
            } else for (i in set_arr) this.__peishu = set_arr[i],
            getnumber = this.__return_quandao()
        }
        return getnumber
    },
    __get_peishu_number: function(arr) {
        var getnum = [];
        for (ii in arr) {
            var g = arr[ii][0] + arr[ii][1] + arr[ii][2] + arr[ii][3],
            n = this.__peishu_quandao(g);
            n = this.__set_unique(n);
            var _guding = this.__arr_guding;
            for (iii in n) {
                var num = n[iii];
                numarr = num.split("");
                stat = 1;
                for (j in _guding)"" != _guding[j] && "x" != numarr[j - 1] && (stat = 0);
                if (0 != stat) {
                    var jj = 0,
                    newarr = [];
                    for (j in _guding) jj = j - 1,
                    gdstr = _guding[j],
                    numarr[jj] = gdstr;
                    a = numarr[0].split(""),
                    b = numarr[1].split(""),
                    c = numarr[2].split(""),
                    d = numarr[3].split("");
                    var jjj = 0;
                    for (i1 = 0; i1 < a.length; i1++) for (i2 = 0; i2 < b.length; i2++) for (i3 = 0; i3 < c.length; i3++) for (i4 = 0; i4 < d.length; i4++) newarr[jjj] = a[i1] + "" + b[i2] + c[i3] + d[i4],
                    jjj++;
                    "" != newarr && (getnum = getnum.concat(newarr))
                }
            }
        }
        return getnum
    },
    __peishu_quandao: function(str) {
        if (str.length < 2) return new Array(str);
        if (2 == str.length) {
            var newArray = new Array;
            return newArray[0] = str.charAt(0) + str.charAt(1),
            newArray[1] = str.charAt(1) + str.charAt(0),
            newArray
        }
        for (var Char = str.charAt(0), str = str.slice(1), arr = this.__peishu_quandao(str), newArray = new Array, i = 0; i < arr.length; i++) for (var j = 0; j <= arr[i].length; j++) {
            var sliceStr = arr[i];
            sliceStr = sliceStr.slice(0, j) + Char + sliceStr.slice(j),
            newArray[i * (arr[i].length + 1) + j] = sliceStr
        }
        return newArray
    },
    __get_peishu_guding: function() {
        if (this.__arr_guding = [], 3 == this.__classid && (1 == $ss("__peishu_qu").checked || 1 == $ss("__peishu_chu").checked)) {
            for (i = 1; i <= 4; i++) {
                var n = $ss("__peishu_" + i).value + "";
                n = this.__set_trim(n),
                $ss("__gd" + i).checked && (n = "" != n ? n: "0123456789", this.__arr_guding[i] = n)
            }
        }
        return this.__arr_guding
    },
    __str_sort: function(arr) {
        var get_arr = [];
        return get_arr = arr.split(""),
        get_arr.sort(),
        arr = get_arr.join("")
    },
    __quandao: "",
    __shangjiang: "",
    __return_quandao: function() {
        var arr = new Array,
        numarr = new Array,
        returnv = !1;
        if (this.__quandao = "" != this.__peishu ? this.__peishu: $ss("__quandao").value, "" != this.__guding_array || "" != this.__quandao || "" != this.__shangjiang && 0 == this.__dingwei_exits) {
            var __qdorsj = "" != this.__quandao ? this.__quandao: this.__shangjiang;
            if (1 == this.__classid) arr = this.__show_erzidingwei(__qdorsj);
            else {
                if ("" != this.__guding_array) arr = this.__guding_array;
                else {
                    if (2 == this.__classid && __qdorsj.length <= 2) return this.__result = "",
                    !0;
                    if (arr = this.__check_zuhe(__qdorsj, 4), null == arr) return ! 0;
                    arr = 3 != this.__classid ? this.__check_weizhi(arr) : this.__check_zuhe_remove(arr)
                }
                for ("" != arr && arr.sort(), i = 0; i < arr.length; i++) numarr = arr[i].split(""),
                this.__numberdata[0] = numarr[0],
                this.__numberdata[1] = numarr[1],
                this.__numberdata[2] = numarr[2] ? numarr[2] : "",
                this.__numberdata[3] = numarr[3] ? numarr[3] : "",
                this.__check_hefen() && this.__check_zhifanwei() && this.__check_hanfushi() && this.__check_chong() && (numberstr = this.__numberdata[0] + this.__numberdata[1] + this.__numberdata[2] + this.__numberdata[3], this.__check_chenghao_reg(numberstr) && this.__check_paichu_reg(numberstr) && this.__check_dingwei_reg(numberstr) && this.__check_dan_reg(numberstr) && this.__check_xiongdi_reg(numberstr) && this.__check_duishu_reg(numberstr) && this.__check__bdwhefen_reg(numberstr) && (this.__result += this.__number_html(numberstr), this.__selectnumber[this.__selectnumbertotal] = numberstr, this.__selectnumbertotal++))
            }
            returnv = !0
        }
        return returnv
    },
    __check_setweizhi: function(str, num, index, obj) {
        if (str.length < num) return null;
        var arr = new Array;
        obj || (obj = new Object);
        for (var ii = 0,
        i = index || 0; i < str.length + 1; i++) if (ii = 0 == i ? 0 : i, str.slice(i, i + 1) != this.__fuhao) {
            var newStr = str.slice(0, i) + this.__fuhao + str.slice(ii);
            if (num > 1) arr = arr.concat(getArray(newStr, num - 1, i + 1, obj));
            else {
                var newStr1 = newStr;
                eval("obj['" + newStr1 + "']") || (arr[arr.length] = newStr, eval("obj['" + newStr1 + "']='" + newStr1 + "';"))
            }
        }
        return arr
    },
    __check_weizhi: function(a) {
        var num = 0;
        1 == this.__classid ? num = 2 : 2 == this.__classid && (num = 0);
        var arrrz = (new Array, new Array),
        arr_remove = (new Object, new Array);
        for (arr_remove = this.__check_zuhe_remove(a), j = 0; j < arr_remove.length; j++) arr_remove[j],
        arrrz = arrrz.concat(this.__check_setweizhi("" + arr_remove[j], num));
        return arrrz
    },
    __dingwei_exits: !1,
    __dingwei_reg: "",
    __dingweitotal: 0,
    __int_dingwei_num: function() {
        var num, arrnum = "",
        comm = "";
        this.__shangjiang = $ss("__shangjiang").value,
        this.__dingwei_exits = !1;
        var data = "0123456789";
        for (this.__dingweitotal = 0, i = 0; i < this.__dingweiarray.length; i++) if ("" != this.__dingweiarray[i]) {
            num = this.__dingweiarray[i],
            arrnum = "",
            arrfuhao = "",
            "";
            var comm = "",
            gnum = "",
            chustr = data;
            if (num.length > 0) for (j = 0; j < num.length; j++) gnum = num.slice(j, j + 1),
            arrnum += comm + gnum,
            arrfuhao = "0-9",
            comm = "|",
            chustr = chustr.replace(gnum, "");
            else arrnum = num,
            arrfuhao = "0-9",
            chustr = "0-9";
            this.__dingwei_reg += "[" + arrnum + "]",
            this.__dingwei_chu_reg += "[" + arrfuhao + "]",
            this.__dingwei_exits = !0,
            this.__dingweitotal++
        } else "" != this.__shangjiang && (data = this.__shangjiang),
        1 == this.__classid && 1 == data.length || 2 == this.__classid && data.length <= 2 || 3 == this.__classid && data.length <= 3 ? (this.__dingwei_exits = !0, this.__dingwei_reg += "[0-9" + this.__fuhao + "]") : this.__dingwei_reg += "[" + data + this.__fuhao + "]",
        this.__dingwei_chu_reg += "[0-9" + this.__fuhao + "]";
        this.__dingwei_reg = new RegExp(this.__dingwei_reg),
        this.__dingwei_chu_reg = new RegExp(this.__dingwei_chu_reg)
    },
    __check_dingwei_reg: function(n) {
        if (0 == this.__dingwei_exits || this.__classid > 3) return ! 0;
        var nn = n,
        shangjiangreturn = !0;
        if ("" != this.__shangjiang) {
            data = this.__shangjiang;
            var geshu = this.__dingweiarray_num;
            if (1 == this.__classid) {
                var digwei = this.__dingweiarray,
                dwnum = 2 - this.__dingweiarray_num,
                datanum = 0;
                nvar = n.split("");
                var zhongfu = "",
                tempStr = "",
                setData1 = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                setData2 = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                for (j = 0; j < nvar.length; j++) {
                    setData1[nvar[j]]++;
                    var dw = !0;
                    digwei[j].indexOf(nvar[j]) != -1 && (dw = !1),
                    tempStr != nvar[j] && dw && (zhongfu += nvar[j] + "", tempStr = nvar[j])
                }
                for (data = data.split(""), j = 0; j < data.length; j++) setData2[data[j]]++,
                zhongfu.indexOf(data[j]) != -1 && datanum++;
                var setData2true = !0;
                for (j = 0; j < setData2.length; j++) setData2[j] > 1 && setData1[j] < setData2[j] && (setData2true = !1);
                shangjiangreturn = !(!(dwnum == datanum || data.length <= datanum) || !setData2true)
            } else if (1 == this.__classid && 1 == data.length || 2 == this.__classid) {
                if (data.length >= 1) {
                    var gnum2 = "",
                    arrnum2 = "",
                    comm2 = "",
                    num = 0,
                    dnum = 0,
                    datanum = data.length;
                    if (geshu > 0 && "" != this.__dingweiarray) for (2 == this.__classid && geshu > 1 ? datanum = 1 : 2 == this.__classid && datanum >= 3 ? datanum = 2 : geshu > 0 && (datanum = data.length), iii = 0; iii < this.__dingweiarray.length; iii++) {
                        var number = this.__dingweiarray[iii];
                        if ("" != number) {
                            valarr = number.split(""),
                            nvar = n.split("");
                            var a_n = 0;
                            for (a = 0; a < valarr.length; a++) data.indexOf(valarr[a]) != -1 && (dnum++, num++, datanum++, nvar[iii] = "|");
                            n = nvar.join("")
                        }
                    }
                    var setnum = "",
                    setdata = data + "";
                    for (j = 0; j < data.length; j++) if (gnum2 = data.slice(j, j + 1), reg = "/" + gnum2 + "/g", reg = eval(reg), len1 = setdata.match(reg), setnum != gnum2) {
                        var lennum = null != len1 && "" != len1 ? len1.length: 0;
                        if (lennum > 1) {
                            len2 = n.match(reg);
                            var lennum2 = null != len2 && "" != len2 ? len2.length: 0;
                            lennum <= lennum2 && (num += lennum, setnum = gnum2)
                        } else n.indexOf(gnum2) != -1 && num++
                    }
                    shangjiangreturn = datanum == num
                }
            } else if (2 == this.__classid && data.length >= 3 && 1 == geshu) {
                ntmp = nn;
                var cf = [];
                for (valarr = nn.split(""), j = 0; j < valarr.length; j++) gnum2 = ntmp.split(valarr[j]).length - 1,
                gnum2 > 1 && (shangjiangreturn = !1)
            } else if (3 == this.__classid) {
                var digwei = this.__dingweiarray,
                dwnum = 4 - this.__dingweiarray_num,
                datanum = 0;
                nvar = n.split("");
                var zhongfu = "",
                tempStr = "",
                setData1 = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                setData2 = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                for (j = 0; j < nvar.length; j++) {
                    setData1[nvar[j]]++;
                    var dw = !0;
                    digwei[j].indexOf(nvar[j]) != -1 && (dw = !1),
                    tempStr != nvar[j] && dw && (zhongfu += nvar[j] + "", tempStr = nvar[j])
                }
                for (data = data.split(""), j = 0; j < data.length; j++) setData2[data[j]]++,
                zhongfu.indexOf(data[j]) != -1 && datanum++;
                var setData2true = !0;
                for (j = 0; j < setData2.length; j++) setData2[j] > 1 && setData1[j] < setData2[j] && (setData2true = !1);
                shangjiangreturn = !(!(dwnum == datanum || data.length <= datanum || 4 == datanum) || !setData2true)
            }
        }
        return this.__dingwei_chu ? !this.__dingwei_reg.test(nn) && this.__dingwei_chu_reg.test(nn) && shangjiangreturn: this.__dingwei_reg.test(nn) && shangjiangreturn
    },
    __check_zuhe: function(str, n, num) {
        if (3 == this.__classid) {
            if (str.length < n) return null;
            if (str.length == n) return this.__check_quandao(str)
        }
        if (str.length < n) return this.__check_quandao(str);
        var newArray = new Array,
        len = str.length - 1;
        len = Math.min(void 0 !== num ? num: len, len);
        for (var i = len; i >= 0; i--) newArray = newArray.concat(this.__check_zuhe(str.substr(0, i) + str.substr(i + 1), n, i - 1));
        return newArray
    },
    __check_zuhe_remove: function(arr) {
        for (var obj = new Object,
        newArray = new Array,
        i = 0; i < arr.length; i++) eval("obj['" + arr[i] + "']") || eval("obj['" + arr[i] + "']='" + arr[i] + "'");
        for (var i in obj) newArray[newArray.length] = obj[i];
        return newArray
    },
    __dingwei_chu: !1,
    __dingweiarray: new Array(3),
    __int_dingwei: function() {
        this.__dingweiarray_num = 0,
        this.__dingwei_chu = this.__classid <= 3 && $ss("__dingwei_chu").checked;
        for (var i = 1; i <= 4; i++) this.__dingweiarray[i - 1] = this.__classid <= 3 ? $ss("__dingwei_" + i).value: "",
        "" != this.__dingweiarray[i - 1] && this.__dingweiarray_num++
    },
    __chenghaoarray: [],
    __chenghao: !1,
    __int_chenghao: function() {
        for (var checkeds, getche = !1,
        i = 0; i < 4; i++) checkeds = $ss("__chenghao_" + (i + 1)).checked,
        1 == checkeds && (getche = !0),
        this.__chenghaoarray[i] = checkeds;
        this.__chenghao = !1,
        0 == getche && (this.__chenghao = !0, 1 == this.__classid ? (this.__chenghaoarray[2] = !0, this.__chenghaoarray[3] = !0) : 2 == this.__classid && (this.__chenghaoarray[3] = !0))
    },
    __int: function() {
        this.__destruct(),
        this.__int_dingwei(),
        this.__int_hefen(),
        this.__int_chenghao(),
        this.__int_hanfushi(),
        this.__int_chong(),
        this.__int_paichu(),
        this.__int_danshuang(),
        this.__int_xiongdi(),
        this.__int_duishu(),
        this.__int_zhifanwei(),
        this.__int_bdwhefen(),
        2 == this.IN_WAPCG || 9 == this.IN_WAPCG || (window.parent.frames.soonselectorder.$("showselectnumber").innerHTML = "数据生成中...")
    },
    __destruct: function() {
        this.__result = "",
        this.__chenghaoarray = new Array,
        this.__dingweiarray = new Array(3),
        this.__dingwei_chu = new Array,
        this.__hefen_zhi = new Array(4),
        this.__hefen_chu = !1,
        this.__hefen_value = !1,
        this.__dingwei_chu = !1,
        this.__selectnumbertotal = 0,
        this.__selectnumber = new Array,
        this.__han = "",
        this.__fushi = "",
        this.__henfushi_chu = "",
        this.__chu_chong = "",
        this.__qu_chong = "",
        this.__chongchecked = !1,
        this.__quandao = "",
        this.__shangjiang = "",
        this.__paichu = "",
        this.__chenghao_reg = "",
        this.__paichu = "",
        this.__paichu_reg = "",
        this.__dingwei_exits = !1,
        this.__dingwei_reg = "",
        this.__dingwei_chu_reg = "",
        this.__dan_chu = !1,
        this.__shuang_chu = !1,
        this.__dan_qu = !1,
        this.__shuang_qu = !1,
        this.__dan_reg = "",
        this.__dan_reg2 = "",
        this.__danshuang_reg = "",
        this.__shuang_reg = "",
        this.__shuang_reg2 = "",
        this.__dan_start = !1,
        this.__shuang_start = !1,
        this.__chu_duishu = !1,
        this.__duishu_1 = "",
        this.__duishu_2 = "",
        this.__duishu_3 = "",
        this.__duishu_reg = "",
        this.__duishu_stat = "",
        this.__zhifanwei_start = "",
        this.__zhifanwei_end = "",
        this.__bdwhefen_1 = !1,
        this.__bdwhefen_2 = !1,
        this.__bdwhefen = "",
        this.__bdwhefenstat = !1
    },
    __hefen_weizhi: new Array,
    __hefen_zhi: new Array(4),
    __hefen_chu: !1,
    __hefen_value: !1,
    __int_hefen: function() {
        this.__hefen_chu = $ss("__hefen_chu").checked;
        for (var che, value, i = 0; i < 4; i++) if (this.__hefen_weizhi[i] = new Array, value = $ss("__hefenzhide_" + (i + 1)).value, "" != value) {
            for (var j = 0; j < 4; j++) che = $ss("__hefenzhide_w_" + (j + 1) + (i + 1)).checked,
            this.__hefen_weizhi[i][j] = che ? j: "-1";
            this.__hefen_zhi[i] = value,
            this.__hefen_value = !0
        } else this.__hefen_zhi[i] = ""
    },
    __check_hefen: function() {
        if (0 == this.__hefen_value) return ! 0;
        for (var hefenvalue, total, getcheck, t, returnvalue = !0,
        statarr = [], statcount = 0, i = 0; i < 4; i++) if (hefenvalue = this.__hefen_zhi[i], "" != hefenvalue) {
            statcount += 1,
            total = "",
            t = "";
            for (var j = 0; j < 4; j++) if (getcheck = this.__hefen_weizhi[i][j], "-1" != getcheck) {
                if (!this.__hefen_chu && this.__numberdata[j] == this.__fuhao) return ! 1;
                total = Math.floor(total) + Math.floor(this.__numberdata[j])
            }
            total += "",
            total.length > 0 && (t = total.substr(total.length - 1, 1));
            var hefenarr = hefenvalue.split("");
            if (hefenarr.length > 1) {
                for (var stat = 0,
                h = 0; h < hefenarr.length; h++) if ("" != t && hefenarr[h] == t) {
                    statarr[statarr.length] = 1,
                    stat = 1;
                    break
                }
                if (0 == stat) {
                    returnvalue = !1;
                    break
                }
            } else {
                if ("" == t || hefenvalue != t) {
                    returnvalue = !1;
                    break
                }
                statarr[statarr.length] = 1
            }
        }
        return returnvalue = statcount > 0 && statcount == statarr.length,
        this.__hefen_chu && (returnvalue = !returnvalue),
        returnvalue
    },
    __bdwhefen_1: !1,
    __bdwhefen_2: !1,
    __bdwhefen: "",
    __bdwhefenstat: !1,
    __int_bdwhefen: function() {
        this.__bdwhefen_1 = $ss("__bdwhefen_1").checked,
        this.__bdwhefen_2 = $ss("__bdwhefen_2").checked,
        this.__bdwhefen = $ss("__bdwhefen").value,
        (this.__bdwhefen_1 || this.__bdwhefen_2) && (this.__bdwhefenstat = !0)
    },
    __check__bdwhefen_reg: function(n) {
        if (0 == this.__bdwhefenstat || "" == this.__bdwhefen) return ! 0;
        var all, a, b, c, returnv = !1,
        arr = n.split(""),
        t = "",
        tongji = 0,
        stat = this.__bdwhefen_1 ? 1 : 2,
        hefenv = "" == this.__bdwhefen ? 0 : this.__bdwhefen;
        if ("" != hefenv) var hefenvarr = hefenv.split("");
        if (1 == stat) for (var i = 0; i < arr.length; i++) {
            for (var j = i + 1; j < arr.length; j++) {
                a = arr[i],
                b = arr[j],
                all = Math.floor(a) + Math.floor(b),
                all += "",
                t = "",
                all.length > 0 && (t = all.substr(all.length - 1, 1));
                for (var h = 0; h < hefenvarr.length; h++) if ("" != t && t == hefenvarr[h]) {
                    returnv = !0,
                    tongji++;
                    break
                }
                if (tongji > 0) break
            }
            if (tongji > 0) break
        } else for (var i = 0; i < arr.length; i++) {
            for (var num = 1 == i ? 1 : 2, c = 1 == i ? 1 : 0, j = i + num; j < arr.length; j++) {
                a = arr[i - c],
                b = arr[i + 1],
                c = arr[j + c],
                all = Math.floor(a) + Math.floor(b) + Math.floor(c),
                all += "",
                t = "",
                all.length > 0 && (t = all.substr(all.length - 1, 1));
                for (var h = 0; h < hefenvarr.length; h++) if ("" != t && t == hefenvarr[h]) {
                    returnv = !0,
                    tongji++;
                    break
                }
                if (c = 0, tongji > 0) break
            }
            if (tongji > 0) break
        }
        return returnv
    },
    __check_er_san_all_dingwei: function() {
        if (1 != this.__classid && 2 != this.__classid || !this.__chenghao || "" != this.__fushi) return ! 1;
        if ("" != this.__shangjiang) {
            if (1 == this.__classid && this.__dingweitotal >= 2) return this.__result = "",
            !0;
            if (2 == this.__classid && this.__dingweitotal >= 3) return this.__result = "",
            !0
        }
        var data = [];
        for (i = 0; i < this.__dingweiarray.length; i++) val = this.__dingweiarray[i] ? this.__dingweiarray[i] : parseInt(this.__dingweiarray[i], 10),
        data[i] = "0123456789",
        this.__dingweiarray[i] && (valarr = val.split(""), getvalarr = valarr.sort(), val = getvalarr.join("")),
        data[i] = this.__dingwei_chu ? data[i] : new RegExp(val).test(data[i]) ? "" + val: data[i],
        data[i] = data[i].split("");
        var n, m, save = [],
        flag = [0, 0, 0, 0],
        count = 0,
        nMax = 0,
        isMove = !1;
        for (space = !1, nMax = 1 == this.__classid ? 2 : 1, n = flag.length - 1; n >= 0; n--) 10 == data[n].length && count < nMax ? (flag[n]++, count++) : flag[n] = 10 == data[n].length ? 0 : -1;
        for (var i = 0; i <= 5; i++) {
            for (n = flag.length - 1; n >= 0; n--) 1 == flag[n] && (save[n] = data[n], data[n] = ["" + this.__fuhao]);
            for (var nnnn = 0,
            a = 0; a < data[0].length; a++) for (var b = 0; b < data[1].length; b++) for (var c = 0; c < data[2].length; c++) for (var d = 0; d < data[3].length; d++) this.__numberdata[0] = data[0][a],
            this.__numberdata[1] = data[1][b],
            this.__numberdata[2] = data[2][c],
            this.__numberdata[3] = data[3][d],
            this.__check_hefen() && this.__check_zhifanwei() && this.__check_hanfushi() && this.__check_chong() && (numberstr = this.__numberdata[0] + this.__numberdata[1] + this.__numberdata[2] + this.__numberdata[3], this.__check_dingwei_reg(numberstr) && this.__check_dan_reg(numberstr) && this.__check_xiongdi_reg(numberstr) && this.__check_duishu_reg(numberstr) && this.__check_paichu_reg(numberstr) && this.__check__bdwhefen_reg(numberstr) && this.__check_hanfushi_reg(numberstr) && (this.__result += this.__number_html(numberstr), this.__selectnumber[this.__selectnumbertotal] = numberstr, this.__selectnumbertotal++)),
            nnnn++;
            for (var n = flag.length - 1; n >= 0; n--) 1 == flag[n] && (data[n] = save[n]);
            for (isMove = !1, count = 0, n = flag.length - 1; n > 0; n--) {
                if (1 == flag[n]) for (count++, m = n - 1; m >= 0; m--) {
                    if (0 == flag[m]) {
                        if (flag[n] = 0, flag[m] = 1, isMove = !0, count == nMax) {
                            for (count = 0, k = 0; k <= m; k++) 1 == flag[k] && count++;
                            for (m = flag.length - 1; m > n; m--) 10 == data[m].length && count < nMax ? (flag[m] = 1, count++) : flag[m] = 10 == data[m].length ? 0 : -1
                        }
                        break
                    }
                    if (1 == flag[m]) break
                }
                if (isMove) break
            }
            if (!isMove) break
        }
        return ! 0
    },
    __check_sanzidingss: 0,
    __check_sanziding: function() {
        if (1 != this.__classid && 2 != this.__classid) return ! 0;
        var a, b, c, returnvalue = !1,
        j = 0,
        numberstr = "";
        if (1 == this.__classid || 2 == this.__classid) {
            if (a = this.__numberdata[0], b = this.__numberdata[1], c = this.__numberdata[2], this.__numberdata[3], this.__chenghao) {
                for (num = 1 == this.__classid ? 5 : 3, i = 0; i <= num; i++) 1 == this.__classid ? 0 == i ? (this.__numberdata[0] = a, this.__numberdata[1] = b, this.__numberdata[2] = this.__fuhao, this.__numberdata[3] = this.__fuhao) : 1 == i ? (this.__numberdata[0] = a, this.__numberdata[1] = this.__fuhao, this.__numberdata[2] = b, this.__numberdata[3] = this.__fuhao) : 2 == i ? (this.__numberdata[0] = a, this.__numberdata[1] = this.__fuhao, this.__numberdata[2] = this.__fuhao, this.__numberdata[3] = b) : 3 == i ? (this.__numberdata[0] = this.__fuhao, this.__numberdata[1] = a, this.__numberdata[2] = b, this.__numberdata[3] = this.__fuhao) : 4 == i ? (this.__numberdata[0] = this.__fuhao, this.__numberdata[1] = a, this.__numberdata[2] = this.__fuhao, this.__numberdata[3] = b) : 5 == i && (this.__numberdata[0] = this.__fuhao, this.__numberdata[1] = this.__fuhao, this.__numberdata[2] = a, this.__numberdata[3] = b) : 0 == i ? (this.__numberdata[0] = a, this.__numberdata[1] = b, this.__numberdata[2] = c, this.__numberdata[3] = this.__fuhao) : 1 == i ? (this.__numberdata[0] = a, this.__numberdata[1] = b, this.__numberdata[2] = this.__fuhao, this.__numberdata[3] = c) : 2 == i ? (this.__numberdata[0] = a, this.__numberdata[1] = this.__fuhao, this.__numberdata[2] = b, this.__numberdata[3] = c) : 3 == i && (this.__numberdata[0] = this.__fuhao, this.__numberdata[1] = a, this.__numberdata[2] = b, this.__numberdata[3] = c),
                numberstr = this.__numberdata[0] + this.__numberdata[1] + this.__numberdata[2] + this.__numberdata[3],
                this.__check_hefen() && this.__check_zhifanwei() && this.__check_hanfushi() && this.__check_chong() && this.__check_dan_reg(numberstr) && this.__check_xiongdi_reg(numberstr) && this.__check_duishu_reg(numberstr) && this.__check_dingwei_reg(numberstr) && this.__check_paichu_reg(numberstr) && this.__check__bdwhefen_reg(numberstr) && this.__check_hanfushi_reg(numberstr) && (this.__result += this.__number_html(numberstr), this.__selectnumber[this.__selectnumbertotal] = numberstr, this.__selectnumbertotal++);
                returnvalue = !1
            } else if (!this.__chenghao) {
                for (i = 0; i < 4; i++) if (1 == this.__chenghaoarray[i]) {
                    if (this.__numberdata[i] = this.__fuhao, 1 == this.__classid && 1 == j) break;
                    if (2 == this.__classid) break;
                    j++
                }
                returnvalue = !0
            }
        } else 4 == this.__classid ? (this.__numberdata[0] = "", this.__numberdata[1] = "", returnvalue = !0) : 5 == this.__classid ? (this.__numberdata[0] = "", returnvalue = !0) : returnvalue = !0;
        return returnvalue
    },
    __zhifanwei_start: "",
    __zhifanwei_end: "",
    __keyup_zhifanwei: function() {},
    __int_zhifanwei: function() {
        this.__zhifanwei_start = $ss("__zhifanwei_start").value,
        this.__zhifanwei_end = $ss("__zhifanwei_end").value
    },
    __check_zhifanwei: function() {
        if ("" == this.__zhifanwei_start && "" == this.__zhifanwei_end || 3 != this.__classid) return ! 0;
        var a, b, c, d, total, htotal, returnvalue = !1,
        __zhifanwei_start = this.__zhifanwei_start,
        __zhifanwei_end = this.__zhifanwei_end;
        return "" != __zhifanwei_start || "" != __zhifanwei_end ? (a = this.__numberdata[0], b = this.__numberdata[1], c = this.__numberdata[2], d = this.__numberdata[3], total = (a || 0 == a ? a - 0 : 0) + (b || 0 == b ? b - 0 : 0) + (c || 0 == c ? c - 0 : 0) + (d || 0 == d ? d - 0 : 0), htotal = total, __zhifanwei_start && __zhifanwei_end ? __zhifanwei_start <= htotal && __zhifanwei_end >= htotal && (returnvalue = !0) : __zhifanwei_start > 0 ? __zhifanwei_start == htotal && (returnvalue = !0) : __zhifanwei_end > 0 && __zhifanwei_end == htotal && (returnvalue = !0)) : returnvalue = !0,
        returnvalue
    },
    __han: "",
    __fushi: "",
    __fushistr: "",
    __henfushi_chu: "",
    __henfushi_qu: !1,
    __int_hanfushi: function() {
        if (this.__han = $ss("__han_" + this.__classid).value, this.__fushi = $ss("__fushi_" + this.__classid).value, this.__henfushi_chu = $ss("__chu_" + this.__classid).checked, this.__henfushi_qu = $ss("__qu_" + this.__classid).checked, "" != this.__fushi) {
            var comm = "",
            fushi = "",
            fushiarr = [],
            fushiarr = this.__fushi.split("");
            for (i = 0; i < fushiarr.length; i++) 1 == this.__classid || 4 == this.__classid ? fushi += comm + fushiarr[i] + "" + fushiarr[i] : 2 == this.__classid || 5 == this.__classid ? fushi += comm + fushiarr[i] + "" + fushiarr[i] + fushiarr[i] : 3 != this.__classid && 6 != this.__classid || (fushi += comm + fushiarr[i] + "" + fushiarr[i] + fushiarr[i] + fushiarr[i]),
            comm = "|";
            this.__fushistr = fushi
        }
    },
    __nnnum: 0,
    __check_hanfushi_reg: function(n) {
        if (this.__chongcheckedchu) return ! 0;
        if ("" == this.__fushi || this.__henfushi_qu == this.__henfushi_chu) return ! 0;
        if (1 == this.__henfushi_qu) return ! 0;
        var returnv = !0,
        reg = "";
        reg = new RegExp("^[" + new String(n).replace(/[\-\\\]]/g, "\\$&") + "]+$");
        var arr = [],
        str = "";
        str = this.__fushi + "|" + this.__fushistr;
        for (var arr = str.split("|"), ii = 0, i = 0; i < arr.length; i++) reg.test(arr[i]) && (ii += 1);
        getnumbernum = ii,
        nn = new String(n);
        for (var reg = /(\d).*\1/,
        t = [], tnum = 0; reg.test(nn);) {
            var $1 = RegExp.$1;
            t = nn.match(new RegExp($1, "g")).join(""),
            tnum++,
            nn = nn.split($1).join("")
        }
        if (t.length > 0) {
            var gettnum = t.length;
            tnum > 1 && (gettnum += 1),
            gettnum >= 2 ? ii = ii + gettnum - 1 : ii += gettnum
        }
        var iival = 0;
        return 1 == this.__classid || 4 == this.__classid ? iival = 2 : 2 == this.__classid || 5 == this.__classid ? iival = 3 : 3 != this.__classid && 6 != this.__classid || (iival = 4),
        0 == this.__chongcheckedchu && 1 == this.__henfushi_chu && getnumbernum >= iival && (ii = iival),
        returnv = ii == iival,
        "" == this.__han && this.__henfushi_chu ? !returnv: this.__henfushi_chu && returnv ? !returnv: returnv
    },
    __check_hanfushi: function() {
        if ("" == this.__han) return ! 0;
        var returnv = !1,
        num = 0;
        if (this.__fushi, "" != this.__han) {
            han = this.__han.split("");
            for (var gnumber = "",
            i = 0; i < 4; i++) gnumber = gnumber + "" + this.__numberdata[i];
            for (j = 0; j < han.length; j++) if (this.__henfushi_chu) gnumber.indexOf(han[j]) == -1 && num++;
            else if (gnumber.indexOf(han[j]) != -1) {
                returnv = !0;
                break
            }
            this.__henfushi_chu && num == han.length && (returnv = !0)
        } else returnv = !0;
        return returnv
    },
    __chu_chong: "",
    __qu_chong: "",
    __chongchecked: !1,
    __int_chong: function() {
        for (this.__chongcheckedchu = !1, i = 1; i <= 4; i++) eval("__ss.__chu_chong_" + i + " = $ss('__chu_chong_" + i + "').checked;"),
        eval("__ss.__qu_chong_" + i + " = $ss('__qu_chong_" + i + "').checked;"),
        0 == this.__chongchecked && (eval("__ss.__chu_chong_" + i) || eval("__ss.__qu_chong_" + i)) && (this.__chongchecked = !0),
        0 == this.__chongcheckedchu && $ss("__chu_chong_" + i).checked && (this.__chongcheckedchu = !0);
        this.__chong_arr_1 = "11|22|33|44|55|66|77|88|99|00".split("|")
    },
    __check_chong: function() {
        if (0 == this.__chongchecked) return ! 0;
        var a, b, c, d, returnv_1 = !1,
        returnv_2 = !1,
        returnv_3 = !1,
        returnv_4 = !1;
        a = this.__numberdata[0],
        b = this.__numberdata[1],
        c = this.__numberdata[2],
        d = this.__numberdata[3];
        var n = a + "" + b + c + d;
        n = new String(n);
        for (var gt, reg = /(\d).*\1/,
        res = [], t = 0; reg.test(n);) {
            var $1 = RegExp.$1,
            t = n.match(new RegExp($1, "g")).join("");
            res.push(t),
            n = n.split($1).join("")
        }
        gt = t.length,
        __ss.__qu_chong_1 && gt >= 2 && (returnv_1 = !0),
        __ss.__chu_chong_1 && (gt >= 2 && (returnv_1 = !0), returnv_1 = !returnv_1),
        __ss.__qu_chong_2 && (2 != res.length && 4 != gt || (returnv_2 = !0)),
        __ss.__chu_chong_2 && 2 != res.length && 4 != gt && (returnv_2 = !0),
        __ss.__qu_chong_3 && gt >= 3 && (returnv_3 = !0),
        __ss.__chu_chong_3 && (gt >= 3 && (returnv_3 = !0), returnv_3 = !returnv_3),
        __ss.__qu_chong_4 && 4 == gt && (returnv_4 = !0),
        __ss.__chu_chong_4 && (4 == gt && (returnv_4 = !0), returnv_4 = !returnv_4);
        var r = !1;
        return 1 == this.__classid || 4 == this.__classid ? r = returnv_1: 2 == this.__classid || 5 == this.__classid ? __ss.__qu_chong_1 && __ss.__qu_chong_3 ? r = returnv_1 || returnv_3: __ss.__chu_chong_1 && __ss.__chu_chong_3 ? r = returnv_1: __ss.__qu_chong_1 && __ss.__chu_chong_3 || __ss.__chu_chong_1 && __ss.__qu_chong_3 ? r = returnv_1 && returnv_3: __ss.__qu_chong_1 || __ss.__chu_chong_1 ? r = returnv_1: (__ss.__qu_chong_3 || __ss.__chu_chong_3) && (r = returnv_3) : 3 != this.__classid && 6 != this.__classid || (__ss.__qu_chong_1 && __ss.__qu_chong_2 && __ss.__qu_chong_3 && __ss.__qu_chong_4 || __ss.__chu_chong_1 && __ss.__chu_chong_2 && __ss.__chu_chong_3 && __ss.__chu_chong_4 ? r = returnv_1: __ss.__qu_chong_1 && __ss.__chu_chong_2 && __ss.__chu_chong_3 && __ss.__chu_chong_4 || __ss.__chu_chong_1 && __ss.__qu_chong_2 && __ss.__qu_chong_3 && __ss.__qu_chong_4 ? r = returnv_1 && returnv_2 && returnv_3 && returnv_4: __ss.__qu_chong_1 && __ss.__qu_chong_2 && __ss.__qu_chong_3 ? r = returnv_1 || returnv_2 || returnv_3: __ss.__chu_chong_1 && __ss.__chu_chong_2 && __ss.__chu_chong_3 ? r = returnv_1: __ss.__qu_chong_1 && __ss.__qu_chong_3 && __ss.__qu_chong_4 ? r = returnv_1: __ss.__qu_chong_1 && __ss.__chu_chong_2 && __ss.__chu_chong_3 || __ss.__chu_chong_1 && __ss.__qu_chong_2 && __ss.__qu_chong_3 ? r = returnv_1 && returnv_2 && returnv_3: __ss.__qu_chong_1 && __ss.__qu_chong_2 || __ss.__chu_chong_1 && __ss.__chu_chong_2 ? r = returnv_1: __ss.__qu_chong_1 && __ss.__chu_chong_2 || __ss.__chu_chong_1 && __ss.__qu_chong_2 ? r = returnv_1 && returnv_2: __ss.__qu_chong_1 && __ss.__qu_chong_3 ? r = returnv_1: __ss.__chu_chong_1 && __ss.__chu_chong_3 ? r = returnv_1 && returnv_3: __ss.__qu_chong_1 && __ss.__chu_chong_3 || __ss.__chu_chong_1 && __ss.__qu_chong_3 ? r = returnv_1 && returnv_3: __ss.__qu_chong_1 && __ss.__qu_chong_4 || __ss.__chu_chong_1 && __ss.__chu_chong_4 ? r = returnv_1 && returnv_4: __ss.__qu_chong_1 && __ss.__chu_chong_4 || __ss.__chu_chong_1 && __ss.__qu_chong_4 ? r = returnv_1 && returnv_4: __ss.__qu_chong_2 && __ss.__qu_chong_3 || __ss.__chu_chong_2 && __ss.__chu_chong_3 ? r = returnv_2 && returnv_3: __ss.__qu_chong_2 && __ss.__chu_chong_3 || __ss.__chu_chong_2 && __ss.__qu_chong_3 ? r = returnv_2 && returnv_3: __ss.__qu_chong_2 && __ss.__qu_chong_4 || __ss.__chu_chong_2 && __ss.__chu_chong_4 ? r = returnv_2 && returnv_4: __ss.__qu_chong_2 && __ss.__chu_chong_4 || __ss.__chu_chong_2 && __ss.__qu_chong_4 ? r = returnv_2 && returnv_4: __ss.__qu_chong_3 && __ss.__qu_chong_4 ? r = returnv_3: __ss.__chu_chong_3 && __ss.__chu_chong_4 ? r = returnv_3 && returnv_4: __ss.__qu_chong_3 && __ss.__chu_chong_4 || __ss.__chu_chong_3 && __ss.__qu_chong_4 ? r = returnv_3 && returnv_4: __ss.__qu_chong_1 || __ss.__chu_chong_1 ? r = returnv_1: __ss.__qu_chong_2 || __ss.__chu_chong_2 ? r = returnv_2: __ss.__qu_chong_3 || __ss.__chu_chong_3 ? r = returnv_3: (__ss.__qu_chong_4 || __ss.__chu_chong_4) && (r = returnv_4)),
        r
    },
    __check_chenghao_reg: function(n) {
        return !! this.__chenghao || !(this.__classid > 2) && this.__chenghao_reg.test(n)
    },
    __int_paichu: function(n) {
        var arr = [],
        str = "";
        this.__paichu = $ss("__paichu").value,
        arr = this.__paichu.split("");
        var comm = "";
        for (i = 0; i < arr.length; i++) str += comm + arr[i],
        comm = "|";
        this.__paichu_reg = new RegExp("(" + str + ")")
    },
    __check_paichu_reg: function(n) {
        return "" == this.__paichu || !this.__paichu_reg.test(n)
    },
    __xiongdi_stat: 0,
    __int_xiongdi: function() {
        var i_s = 1;
        for (i = 1; i <= 3; i++) eval("__ss.__chu_xiongdi_" + i + " = ''");
        for (1 == this.__classid || 4 == this.__classid ? i_s = 1 : 2 == this.__classid || 5 == this.__classid ? i_s = 2 : 3 != this.__classid && 6 != this.__classid || (i_s = 3), this.__xiongdi_stat = !1, i = 1; i <= i_s; i++) eval("__ss.__chu_xiongdi_" + i + " = $ss('__chu_xiongdi_" + i + "').checked;"),
        eval("__ss.__qu_xiongdi_" + i + " = $ss('__qu_xiongdi_" + i + "').checked;"),
        (eval("__ss.__chu_xiongdi_" + i) || eval("__ss.__qu_xiongdi_" + i)) && (this.__xiongdi_stat = !0);
        this.__xiongdi_arr_1 = "12|23|34|45|56|67|78|89|90|01".split("|"),
        this.__xiongdi_arr_2 = "123|234|345|456|567|678|789|890|901|012".split("|"),
        this.__xiongdi_arr_3 = "1234|2345|3456|4567|5678|6789|7890|8901|9012|0123".split("|")
    },
    __xiongdi_reg_1: function(n) {
        for (var returnv = !1,
        reg = new RegExp("^[" + new String(n).replace(/[\-\\\]]/g, "\\$&") + "]+$"), i = 0; i < this.__xiongdi_arr_1.length; i++) if (reg.test(this.__xiongdi_arr_1[i])) {
            returnv = !0;
            break
        }
        return returnv
    },
    __xiongdi_reg_2: function(n) {
        for (var returnv = !1,
        reg = new RegExp("^[" + new String(n).replace(/[\-\\\]]/g, "\\$&") + "]+$"), i = 0; i < this.__xiongdi_arr_2.length; i++) if (reg.test(this.__xiongdi_arr_2[i])) {
            returnv = !0;
            break
        }
        return returnv
    },
    __xiongdi_reg_3: function(n) {
        for (var returnv = !1,
        reg = new RegExp("^[" + new String(n).replace(/[\-\\\]]/g, "\\$&") + "]+$"), i = 0; i < this.__xiongdi_arr_3.length; i++) if (reg.test(this.__xiongdi_arr_3[i])) {
            returnv = !0;
            break
        }
        return returnv
    },
    __check_xiongdi_reg: function(n) {
        if (0 == this.__xiongdi_stat) return ! 0;
        var returnv_1 = !1,
        returnv_2 = !1,
        returnv_3 = !1;
        return __ss.__qu_xiongdi_1 ? returnv_1 = this.__xiongdi_reg_1(n) : __ss.__chu_xiongdi_1 && (returnv_1 = !this.__xiongdi_reg_1(n)),
        __ss.__qu_xiongdi_2 ? returnv_2 = this.__xiongdi_reg_2(n) : __ss.__chu_xiongdi_2 && (returnv_2 = !this.__xiongdi_reg_2(n)),
        __ss.__qu_xiongdi_3 ? returnv_3 = this.__xiongdi_reg_3(n) : __ss.__chu_xiongdi_3 && (returnv_3 = !this.__xiongdi_reg_3(n)),
        1 == this.__classid || 4 == this.__classid ? r = returnv_1: __ss.__qu_xiongdi_1 && __ss.__qu_xiongdi_2 && __ss.__qu_xiongdi_3 || __ss.__chu_xiongdi_1 && __ss.__chu_xiongdi_2 && __ss.__chu_xiongdi_3 ? r = returnv_1: __ss.__qu_xiongdi_1 && __ss.__chu_xiongdi_2 && __ss.__chu_xiongdi_3 || __ss.__chu_xiongdi_1 && __ss.__qu_xiongdi_2 && __ss.__qu_xiongdi_3 ? r = returnv_1 && returnv_2 && returnv_3: __ss.__qu_xiongdi_1 && __ss.__qu_xiongdi_2 ? r = returnv_1: __ss.__chu_xiongdi_1 && __ss.__chu_xiongdi_2 ? r = returnv_1 && returnv_2: __ss.__qu_xiongdi_1 && __ss.__chu_xiongdi_2 || __ss.__chu_xiongdi_1 && __ss.__qu_xiongdi_2 ? r = returnv_1 && returnv_2: __ss.__qu_xiongdi_1 && __ss.__qu_xiongdi_3 ? r = returnv_1: __ss.__chu_xiongdi_1 && __ss.__chu_xiongdi_3 ? r = returnv_1 && returnv_3: __ss.__qu_xiongdi_1 && __ss.__chu_xiongdi_3 || __ss.__chu_xiongdi_1 && __ss.__qu_xiongdi_3 ? r = returnv_1 && returnv_3: __ss.__qu_xiongdi_2 && __ss.__qu_xiongdi_3 ? r = returnv_2: __ss.__chu_xiongdi_2 && __ss.__chu_xiongdi_3 ? r = returnv_2 && returnv_3: __ss.__qu_xiongdi_2 && __ss.__chu_xiongdi_3 || __ss.__chu_xiongdi_2 && __ss.__qu_xiongdi_3 ? r = returnv_2 && returnv_3: __ss.__qu_xiongdi_1 || __ss.__chu_xiongdi_1 ? r = returnv_1: __ss.__qu_xiongdi_2 || __ss.__chu_xiongdi_2 ? r = returnv_2: (__ss.__qu_xiongdi_3 || __ss.__chu_xiongdi_3) && (r = returnv_3),
        r
    },
    __chu_duishu: !1,
    __duishu_1: "",
    __duishu_2: "",
    __duishu_3: "",
    __duishu_reg: "",
    __duishu_stat: "",
    __int_duishu: function() {
        var getval, arr = new Array,
        getstr = "",
        comm = "",
        g = "",
        duishu = !1;
        if (this.__chu_duishu = $ss("__chu_duishu").checked, this.__qu_duishu = $ss("__qu_duishu").checked, this.__duishu_1 = $ss("__duishu_1").value, this.__duishu_2 = $ss("__duishu_2").value, this.__duishu_3 = $ss("__duishu_3").value, arr[0] = "05", arr[1] = "16", arr[2] = "27", arr[3] = "38", arr[4] = "49", "" == this.__duishu_1 && "" == this.__duishu_2 && "" == this.__duishu_3 || (arr = new Array, duishu = !0), this.__chu_duishu || this.__qu_duishu || duishu) {
            for (this.__duishu_stat = !0, "" != this.__duishu_1 && (arr[arr.length] = this.__duishu_1), "" != this.__duishu_2 && (arr[arr.length] = this.__duishu_2), "" != this.__duishu_3 && (arr[arr.length] = this.__duishu_3), i = 0; i < arr.length; i++) getval = arr[i],
            g = getval.split(""),
            getstr += comm + "(" + g[0] + "[^" + g[1] + "]*" + g[1] + "|" + g[1] + "[^" + g[0] + "]*" + g[0] + ")",
            comm = "|";
            this.__duishu_reg = new RegExp(getstr),
            this.__qu_duishu
        }
    },
    __check_duishu_reg: function(n) {
        return ! this.__duishu_stat || (this.__chu_duishu ? !this.__duishu_reg.test(n) : this.__duishu_reg.test(n))
    },
    __dan_chu: !1,
    __shuang_chu: !1,
    __dan_qu: !1,
    __shuang_qu: !1,
    __dan_reg: "",
    __dan_reg2: "",
    __danshuang_reg: "",
    __dan_start: !1,
    __shuang_start: !1,
    __shuang_reg: "",
    __ds_num1: 0,
    __ds_num2: 0,
    __int_danshuang: function() {
        var d_checkeds, s_checkeds, i_s = 0;
        this.__dan_chu = $ss("__dan_chu").checked,
        this.__shuang_chu = $ss("__shuang_chu").checked,
        this.__dan_qu = $ss("__dan_qu").checked,
        this.__shuang_qu = $ss("__shuang_qu").checked;
        i_s = 4 == this.__classid ? 3 : 5 == this.__classid ? 2 : 1;
        for (var i = i_s; i <= 4; i++) d_checkeds = $ss("__dan_" + i).checked,
        s_checkeds = $ss("__shuang_" + i).checked,
        1 == d_checkeds ? (this.__dan_start = !0, this.__dan_reg += "[13579]") : 1 == s_checkeds && this.__shuang_qu ? this.__dan_reg += "[02468" + this.__fuhao + "]": this.__dan_reg += "[0-9" + this.__fuhao + "]",
        1 == s_checkeds ? (this.__shuang_start = !0, this.__shuang_reg += "[02468]") : 1 == d_checkeds && this.__dan_qu ? this.__shuang_reg += "[13579" + this.__fuhao + "]": this.__shuang_reg += "[0-9" + this.__fuhao + "]",
        this.__danshuang_reg += 1 == d_checkeds || 1 == s_checkeds ? "[0-9]": "[0-9" + this.__fuhao + "]";
        this.__dan_reg = new RegExp(this.__dan_reg, "i"),
        this.__shuang_reg = new RegExp(this.__shuang_reg, "i"),
        this.__danshuang_reg = new RegExp(this.__danshuang_reg, "i")
    },
    __check_dan_reg: function(n) {
        if (!this.__dan_start && !this.__shuang_start) return ! 0;
        var dan = !0,
        shuang = !0,
        danshuang = !0;
        return this.__dan_start && (dan = this.__dan_reg.test(n)),
        this.__shuang_start && (shuang = this.__shuang_reg.test(n)),
        danshuang = this.__danshuang_reg.test(n),
        this.__dan_chu && this.__shuang_qu ? !dan && shuang: this.__dan_qu && this.__shuang_chu ? dan && !shuang: this.__dan_chu && !this.__shuang_chu ? !dan: !this.__dan_chu && this.__shuang_chu ? !shuang: this.__dan_chu && this.__shuang_chu ? 1 == this.__classid || 2 == this.__classid ? !(dan || shuang) && danshuang: !(dan || shuang) : this.__dan_qu && !this.__shuang_qu ? dan: !this.__dan_qu && this.__shuang_qu ? shuang: !this.__dan_qu || !this.__shuang_qu || dan && shuang
    },
    __totals: 0,
    alltotals: 0,
    ___daochu: function(n) {
        var newn = "",
        getarr = [],
        data = [],
        a_s = 0,
        b_s = 0,
        arr = [];
        if (!obj) var obj = new Object;
        n = n.split(""),
        n = n.sort(function(a, b) {
            return a - b
        }),
        n = n.join("");
        for (var i = 0; i < 2; i++) data[i] = n,
        data[i] = data[i].split("");
        for (var a = 0; a < data[0].length; a++) for (var b = 0; b < data[1].length; b++) newn = data[0][a] + data[1][b] + "",
        data[0][a] == data[1][b] && 0 == this.__check_shong(newn, n) || 4 == this.__classid && data[0][a] > data[1][b] || eval("obj['" + newn + "']") || (getarr[getarr.length] = newn, eval("obj['" + newn + "']='" + newn + "';"));
        return getarr
    },
    __check_shong: function(newn, n) {
        if (void 0 !== n) return n.indexOf(newn) != -1
    },
    __get_daochu: function(n, indexs) {
        var fuhao = {
            0 : {
                0 : 0,
                1 : 0,
                2 : 1,
                3 : 1
            },
            1 : {
                0 : 0,
                1 : 1,
                2 : 0,
                3 : 1
            },
            2 : {
                0 : 0,
                1 : 1,
                2 : 1,
                3 : 0
            },
            3 : {
                0 : 1,
                1 : 0,
                2 : 0,
                3 : 1
            },
            4 : {
                0 : 1,
                1 : 0,
                2 : 1,
                3 : 0
            },
            5 : {
                0 : 1,
                1 : 1,
                2 : 0,
                3 : 0
            }
        };
        fuhao = fuhao[indexs];
        var newn = "",
        j = 0;
        for (var i in fuhao) 1 == fuhao[i] ? newn += "X": (newn += n.slice(j, j + 1), j++);
        return newn
    },
    __getnew: [],
    __show_daochu: function(arr, num) {
        for (var newn = [], newn = "", i = 0; i < arr.length; i++) newn = this.__get_daochu(arr[i], num),
        numarr = newn.split(""),
        this.__numberdata[0] = numarr[0],
        this.__numberdata[1] = numarr[1],
        this.__numberdata[2] = numarr[2] ? numarr[2] : "",
        this.__numberdata[3] = numarr[3] ? numarr[3] : "",
        this.__check_hefen() && this.__check_zhifanwei() && this.__check_hanfushi() && this.__check_chong() && (numberstr = this.__numberdata[0] + this.__numberdata[1] + this.__numberdata[2] + this.__numberdata[3], this.__check_chenghao_reg(numberstr) && this.__check_paichu_reg(numberstr) && this.__check_dingwei_reg(numberstr) && this.__check_dan_reg(numberstr) && this.__check_xiongdi_reg(numberstr) && this.__check_duishu_reg(numberstr) && this.__check__bdwhefen_reg(numberstr) && (this.__getnew[this.__getnew.length] = numberstr));
        return num < 5 && (num += 1, newn = newn.concat(this.__show_daochu(arr, num))),
        newn
    },
    __show_erzidingwei: function(n) {
        var getarr = [];
        this.__getnew = [],
        getarr = this.__show_daochu(this.___daochu(n), 0),
        "" != this.__getnew && this.__getnew.sort(),
        this.__getnew = this.__check_zuhe_remove(this.__getnew);
        for (var i = 0; i < this.__getnew.length; i++) numberstr = this.__getnew[i],
        this.__result += this.__number_html(numberstr),
        this.__selectnumber[this.__selectnumbertotal] = numberstr,
        this.__selectnumbertotal++;
        return getarr
    },
    __get_dingweizhi: function() {
        var val = "";
        for (i = 0; i < this.__dingweiarray.length; i++) this.__dingweiarray[i] && (val += this.__dingweiarray[i]);
        return valarr = val.split(""),
        valarr
    },
    __chenghao_reg: "",
    __alert: function() {
        var num = 0;
        if (1 == this.__classid || 2 == this.__classid) {
            for (var i = 0; i < 4; i++) 1 == this.__chenghaoarray[i] ? (this.__chenghao_reg += this.__fuhao, num++) : this.__chenghao_reg += "\\d";
            if (this.__chenghao_reg = new RegExp(this.__chenghao_reg), 1 == this.__classid && num > 0 && 2 != num) return alert("请选中正确的乘号位置！"),
            !1;
            if (2 == this.__classid && num > 0 && 1 != num) return alert("请选中正确的乘号位置！"),
            !1
        }
        return ! 0
    },
    __changyong: function() {
        if ($ss("__changyong").checked) {
            var arr = _changyongnumber.split(",");
            for (i = 0; i < arr.length; i++) numberstr = arr[i],
            "" != numberstr && (this.__result += this.__number_html(numberstr), this.__selectnumber[this.__selectnumbertotal] = numberstr, this.__selectnumbertotal++);
            return this.__result
        }
        return ""
    },
    __create: function() {
        if (this.__isempty()) return void alert("请选择或填写条件生成");
        if (this.__int(), 0 != this.__alert()) {
            var shownumber = "";
            if (shownumber = this.__dingweizhi(), 2 == this.IN_WAPCG || 9 == this.IN_WAPCG) {
                if (9 == this.IN_WAPCG) {
                    var html = this.__getHTML(__ss.__selectnumbertotal, __ss.__selectnumber);
                    $("#showselectnumber").html("" != __ss.__selectnumber ? html: "<tr><td height=200>没有这样的号码。</td></tr>"),
                    $ss("selectnumbertotal").innerHTML = this.__selectnumbertotal
                }
                $ss("selectnumber").value = this.__selectnumber,
                $ss("selectnumbertotal_hidden").value = this.__selectnumbertotal,
                $ss("selectlogs").value = this.__setselectlogs()
            } else this.__innerHTML(shownumber)
        }
    },
    __getHTML: function(total, snumber) {
        var row = Math.floor(total / 8),
        rownum = total % 8,
        html = "",
        idx = 0;
        9 != this.IN_WAPCG && (html = '<table cellspacing="0" cellpadding="0" class=showselectnumber border="0" style="text-align:left;width:100%"><tbody>');
        for (var i = 0; i < row; i++) html += "<tr><td >" + snumber[idx] + "</td>",
        idx++,
        html += "<td>" + snumber[idx] + "</td>",
        idx++,
        html += "<td>" + snumber[idx] + "</td>",
        idx++,
        html += "<td>" + snumber[idx] + "</td>",
        idx++,
        html += "<td>" + snumber[idx] + "</td>",
        idx++,
        html += "<td>" + snumber[idx] + "</td>",
        idx++,
        html += "<td>" + snumber[idx] + "</td>",
        idx++,
        html += "<td>" + snumber[idx] + "</td>",
        idx++;
        if (rownum > 0) {
            html += "<tr>";
            for (var i = 0; i < rownum; i++) snumber[idx] && (html += "<td>" + snumber[idx] + "</td>", idx++);
            for (i; i < 8; i++) html += "<td>--</td>";
            html += "</tr>"
        }
        return 9 != this.IN_WAPCG && (html += "</tbody></table>"),
        html
    },
    __innerHTML: function(shownumber) {
        var objfra = window.parent.frames.soonselectorder,
        html = this.__getHTML(__ss.__selectnumbertotal, __ss.__selectnumber);
        "" == shownumber && (html = "没有这样的号码。"),
        objfra.$("showselectnumber").innerHTML = html,
        objfra.$("selectnumber").value = this.__selectnumber,
        objfra.$("selectnumbertotal").innerHTML = this.__selectnumbertotal,
        objfra.$("selectnumbertotal_hidden").value = this.__selectnumbertotal,
        objfra.$("selectlogs").value = this.__setselectlogs(),
        setTimeout('window.parent.frames["soonselectorder"].$("money").focus();', 600)
    },
    __showdis: function(my, to) {
        $ss(to).checked && ($ss(to).checked = !1),
        this.__showpeishu(to),
        this.__danshuangchoqu(to)
    },
    __showpeishu: function(to) {
        if ("__dingwei_qu" == to || "__dingwei_chu" == to) $ss("__peishu_qu").checked = !1,
        $ss("__peishu_chu").checked = !1,
        $ss("s2").style.display = "",
        $ss("s3").style.display = "",
        $ss("s12").style.display = "none",
        3 == this.__classid && ($ss("psgdstr").style.display = "none", 1 != this.IN_WAPCG && 2 != this.IN_WAPCG || ($ss("s14").style.display = "none"));
        else if ("__peishu_qu" == to || "__peishu_chu" == to) {
            $ss("__dingwei_qu").checked = !1,
            $ss("__dingwei_chu").checked = !1,
            $ss("s2").style.display = "none",
            $ss("s3").style.display = "none",
            $ss("s12").style.display = "",
            3 == this.__classid && ($ss("psgdstr").style.display = "", 1 != this.IN_WAPCG && 2 != this.IN_WAPCG || ($ss("s14").style.display = ""));
            for (var i = 1; i <= 4; i++) $ss("__dingwei_" + i).value = ""
        }
    },
    __danshuangchoqu: function(s) {
        "__dan_qu" == s || "__dan_chu" == s ? __ss.__danshuangset(1) : "__shuang_qu" != s && "__shuang_chu" != s || __ss.__danshuangset(2)
    },
    __danshuangset: function(s) {
        var str = "";
        this.__dan_chu = $ss("__dan_chu").checked,
        this.__shuang_chu = $ss("__shuang_chu").checked,
        this.__dan_qu = $ss("__dan_qu").checked,
        this.__shuang_qu = $ss("__shuang_qu").checked;
        var name = "dan",
        namech = "单";
        if (2 == s) {
            if (name = "shuang", namech = "双", $ss(name + "2").innerHTML = "", !this.__shuang_chu && !this.__shuang_qu) return;
            str = this.__shuang_chu ? "除 ": "取 "
        } else {
            if ($ss(name + "2").innerHTML = "", !this.__dan_chu && !this.__dan_qu) return;
            str = this.__dan_chu ? "除 ": "取 "
        }
        var num = 1;
        4 == this.__classid ? num = 3 : 5 == this.__classid && (num = 2);
        var hao = "#";
        1 != this.__classid && 2 != this.__classid && 3 != this.__classid || (hao = "X");
        for (var i = num; i <= 4; i++) {
            str += $ss("__" + name + "_" + i).checked ? namech: hao
        }
        $ss(name + "2").innerHTML = str,
        $ss(name + "2").style.color = "#006600"
    },
    __danshuangshow: function() {
        for (var i = 1; i <= 4; i++) {
            $ss("__dan_" + i).onclick = function() {
                __ss.__danshuangset(1)
            };
            $ss("__shuang_" + i).onclick = function() {
                __ss.__danshuangset(2)
            }
        }
    }
},
cgMember = {
    credits_remaining: 0,
    credits_use: 0,
    divname: "memberList",
    GetMember: function(data) {
        var json = eval(data),
        s = json.s;
        s > 9e3 ? jAlert(data.m + "", "提示框",
        function() {
            cgOrber.logout()
        }) : s > 8e3 ? jAlert(data.m + "", "提示框",
        function() {}) : 200 == s ? ($("#m_username").text(json.username), $("#m_nickname").text(json.nickname), $("#m_credits").text(json.credits), 0 == json.entermode ? ($("input:radio[name=entermode]:eq(0)").prop("checked", !0), $("input:radio[name=entermode]:eq(1)").prop("checked", !1)) : ($("input:radio[name=entermode]:eq(0)").prop("checked", !1), $("input:radio[name=entermode]:eq(1)").prop("checked", !0)), 1 == json.sendmode ? ($("input:radio[name=sendmode]:eq(0)").prop("checked", !0), $("input:radio[name=sendmode]:eq(1)").prop("checked", !1)) : ($("input:radio[name=sendmode]:eq(0)").prop("checked", !1), $("input:radio[name=sendmode]:eq(1)").prop("checked", !0)), 1 == json.isfpfrankhotzhuan ? ($("input:radio[name=isfpfrankhotzhuan]:eq(0)").prop("checked", !0), $("input:radio[name=isfpfrankhotzhuan]:eq(1)").prop("checked", !1)) : ($("input:radio[name=isfpfrankhotzhuan]:eq(0)").prop("checked", !1), $("input:radio[name=isfpfrankhotzhuan]:eq(1)").prop("checked", !0)), cgMember.MemberList(json)) : jAlert("未知错误", "提示框",
        function() {})
    },
    MemberList: function(json) {
        var dlist = json.memberitme,
        mfix = json.mfix;
        $("#" + cgMember.divname).empty(),
        $("#" + cgMember.divname).html("");
        var html = "";
        dlist.length;
        0 != isNull(dlist) && $.each(dlist,
        function(ii, item) {
            var pid = dlist[ii].p,
            id = dlist[ii].id,
            n = dlist[ii].n,
            l = dlist[ii].l,
            f = dlist[ii].f,
            o = dlist[ii].o,
            t = dlist[ii].t,
            s = dlist[ii].s,
            sf = dlist[ii].sf,
            gmfix = mfix[ii],
            selectObj = cgMember.listselect(pid, id, s, sf, gmfix);
            if (1 == id || 4 == id) html = '<tr class="xiazhukuang2"><th class="mred">' + n + '</th><th> </th><th> </th><th> </th><th> </th><th><select name="hs_' + id + '" id="hs_' + id + '" style="display:none"><option value="0" >0</option></select></th><th> </th></tr>';
            else {
                html = "<tr><td " + (0 == pid ? 'class="mred" ': "") + ">" + n + "</td><td>" + l + "</td><td>" + f + "</td><td>" + o + "</td><td>" + t + "</td><td>" + selectObj.s + "</td><td>" + selectObj.f + "</td></tr>"
            }
            $("#" + cgMember.divname).append(html)
        }),
        dlist = "",
        html = "",
        $("#" + cgMember.divname + " select").change(function() {
            var checkIndex = $(this).get(0).selectedIndex,
            gid = $(this).prop("id"),
            gpid = $(this).attr("data-pid"),
            arrid = gid.split("_");
            1 == gpid && 102 == arrid[1] || 4 == gpid && 106 == arrid[1] ? $("#" + cgMember.divname + " select").each(function() {
                $(this).attr("data-pid") == gpid && ($(this).get(0).selectedIndex = checkIndex)
            }) : ($("#fs_" + arrid[1]).get(0).selectedIndex = checkIndex, $("#hs_" + arrid[1]).get(0).selectedIndex = checkIndex)
        })
    },
    listselect: function(pid, id, shs, sfs, mfix) {
        for (var html1 = "",
        html2 = "",
        hj = mfix.hj,
        hb = (mfix.hs, mfix.hb), fj = mfix.fj, fs = mfix.fs, hnum = (mfix.fb, Math.round((hb - 0) / (hj - 0))), ghs = "", gfs = "", i = 0; i <= hnum; i++) {
            var fz = "",
            hz = "";
            if (sfs == fs && (fz = "selected"), shs == hb && (hz = "selected"), ghs += '<option value="' + hb + '" ' + hz + ">" + hb + "</option>", gfs += '<option value="' + fs + '" ' + fz + ">" + fs + "</option>", hb <= 0 || fs <= 0) break;
            hb = cgCheckSend.FloatSubtr(hb, hj),
            fs = cgCheckSend.FloatAdd(fs, fj),
            hb = Number(hb.toFixed(5)),
            fs = Number(fs.toFixed(2))
        }
        return html1 = '<select name="hs_' + id + '" id="hs_' + id + '" data-pid="' + pid + '" class="chosen-select" data-placeholder="交易回水" style="width:100px;">' + ghs + "</select>",
        html2 = '<select name="fs_' + id + '" id="fs_' + id + '" data-pid="' + pid + '" class="chosen-select" data-placeholder="赔率" style="width:100px;">' + gfs + "</select>",
        {
            s: html1,
            f: html2
        }
    },
    GetSendMember: function(data) {
        var json = eval(data),
        s = json.s;
        if (s > 9e3) jAlert(data.m + "", "提示框",
        function() {
            cgOrber.logout()
        });
        else if (s > 8e3) jAlert(data.m + "", "提示框",
        function() {});
        else if (200 == s) {
            var em = $('.memberright input[name="entermode"]:checked ').val(),
            sm = $('.memberright input[name="sendmode"]:checked ').val();
            cgOrber.entermode = em,
            LeftPintIframe.refresh(),
            jAlert(data.m + "", "提示框",
            function() {})
        } else jAlert("未知错误", "提示框",
        function() {})
    },
    sendMember: function() {
        var comm = "",
        strhuishui = "";
        $("#" + cgMember.divname + " select").each(function() {
            "hs" == $(this).prop("id").split("_")[0] && (strhuishui += comm + $(this).children("option:selected").val() + "", comm = "|")
        }),
        jsonAjax("appindexajax.php", "POST", "action=member&editmember=1&entermode=" + $('.memberright input[name="entermode"]:checked ').val() + "&sendmode=" + $('.memberright input[name="sendmode"]:checked ').val() + "&isfpfrankhotzhuan=" + $('.memberright input[name="isfpfrankhotzhuan"]:checked ').val() + "&strhuishui=" + strhuishui, "json", cgMember.GetSendMember)
    },
    init: function() {
        $("#memberbut").unbind("click").click(function() {
            cgMember.sendMember()
        })
    }
},
cgDetail = {
    credits_remaining: 0,
    credits_use: 0,
    pages: 0,
    divname: "DetailList",
    GetDetail: function(data) {
        var json = eval(data),
        s = json.s;
        s > 9e3 ? jAlert(data.m + "", "提示框",
        function() {
            cgOrber.logout()
        }) : s > 8e3 ? jAlert(data.m + "", "提示框",
        function() {}) : 200 == s ? ($("#DetailcheckboxALLID").attr("checked", !1), "award" == json.doaction ? "" == json.issueno || json.issueno == json.issueno_now ? $("#ds_title").text("本期中奖明细") : $("#ds_title").text("第" + json.issueno + "期 中奖明细") : "" == json.issueno ? $("#ds_title").text("本期下注明细") : $("#ds_title").text("第" + json.issueno + "期 下注明细"), $("#ds_s_issueno").text(json.issueno), cgDetail.detailList(json), cgDetail.pages = json.pages, 1 == json.pages && cgDetail.setPage(json.zallnum - 0, json.allpage - 0, json.numpage - 0)) : jAlert("未知错误", "提示框",
        function() {})
    },
    setPage: function(allnum, allpage, numpage) {
        if (0 == allnum) $("#DetailListPager").hide();
        else {
            var setsan = cgDetail.setSearch();
            $("#DetailListPager").show(),
            $("#DetailListPager").jqPaginator({
                totalCounts: allnum,
                totalPages: allpage,
                pageSize: numpage,
                visiblePages: 10,
                currentPage: 1,
                wrapper: "",
                onPageChange: function(num, type) {
                    jsonAjax("appindexajax.php", "get", "action=detail&page=" + num + setsan, "json", cgDetail.GetDetail)
                }
            })
        }
    },
    detailList: function(json) {
        var dlist = json.detailitem;
        if ("detailprint" == json.doaction);
        else {
            $("#" + cgDetail.divname).empty(),
            $("#" + cgDetail.divname).html("");
            var thobj = $("#tab_detail .xiazhukuang2");
            "award" == json.doaction ? (thobj.children("th:eq(1)").text("小票编号"), thobj.children("th:eq(2)").text("小票时间")) : (thobj.children("th:eq(1)").text("注单编号"), thobj.children("th:eq(2)").text("下单时间"))
        }
        var html = "",
        allmoney = 0,
        allhitaward = 0,
        allhuishui = 0,
        allyingkui = 0,
        getnum = 0;
        0 != isNull(dlist) && $.each(dlist,
        function(ii, item) {
            var id = dlist[ii].id,
            orderid = dlist[ii].o,
            number = dlist[ii].n,
            frank = dlist[ii].f,
            money = dlist[ii].m,
            statsizi = dlist[ii].sz,
            classid = dlist[ii].classid,
            stattuima = dlist[ii].st,
            hotstat = dlist[ii].hs,
            tuima = dlist[ii].sm,
            datetime = dlist[ii].dt,
            tuimatime = dlist[ii].tm,
            hitaward = dlist[ii].am,
            huishui = dlist[ii].hm5,
            yingkui = dlist[ii].yk,
            yanse = dlist[ii].ys,
            sizitext = "",
            tuimatext = "退码",
            stattext = "成功",
            hotcss = "",
            showtuimadate = "",
            yansehtml = "";
            yanse > 0 && (yansecss = 1 == yanse ? "#339900": "#ff0000", yansehtml = "<font color='" + yansecss + "' size='4'>●</font>"),
            1 != statsizi && 6 != classid && 7 != classid || (sizitext = "现"),
            1 == stattuima ? (tuimatext = "--", hotcss = 'class="tuima"', stattext = "退码", "detailprint" != json.doaction && (showtuimadate = "<br>退" + tuimatime)) : (1 == hotstat && (hotcss = 'class="hotcss"'), tuimatext = 2 == tuima || 3 == tuima ? '<input id="checkboxID' + id + '" type="checkbox" value="' + id + '"/>': "--", getnum++, allmoney = cgCheckSend.FloatAdd(allmoney, money), hitaward > 0 && (allhitaward = cgCheckSend.FloatAdd(allhitaward, hitaward)), allhuishui = cgCheckSend.FloatAdd(allhuishui, huishui), allyingkui = cgCheckSend.FloatAdd(allyingkui, yingkui), allmoney = Number(allmoney.toFixed(2)), allhitaward = Number(allhitaward.toFixed(2)), allhuishui = Number(allhuishui.toFixed(2)), allyingkui = Number(allyingkui.toFixed(2))),
            "detailprint" == json.doaction ? html += "<tr " + hotcss + "><td>" + yansehtml + cgOrber.caizhongarr[cgOrber.caizhongselect] + "</td><td>" + orderid + "</td><td>" + datetime + showtuimadate + '</td><td class="number">' + number + "<span>" + sizitext + '</span></td><td class="money">' + money + '</td><td class="frank">' + frank + "</td><td>" + stattext + "</td></tr>": (html = "<tr " + hotcss + "><td>" + yansehtml + cgOrber.caizhongarr[cgOrber.caizhongselect] + "</td><td>" + orderid + "</td><td>" + datetime + showtuimadate + '</td><td class="number">' + number + "<span>" + sizitext + '</span></td><td class="money">' + money + '</td><td class="frank">' + frank + "</td><td >" + hitaward + "</td><td >" + huishui + "</td><td >" + yingkui + "</td><td>" + stattext + "</td><td>" + tuimatext + "</td></tr>", $("#" + cgDetail.divname).append(html))
        }),
        "detailprint" == json.doaction ? (html += '<tr id="detailheji"><td colspan=2>合计</td><td>' + getnum + "</td><td > </td><td>" + allmoney + "</td><td> </td><td> </td></tr>", cgDetail.detailPrint(html, "第" + (json.issueno > 0 ? json.issueno: json.issueno_now) + "期 " + json.printdate + "   下注明细")) : (html = '<tr id="detailheji"><td colspan=2>合计</td><td>' + getnum + "</td><td > </td><td>" + allmoney + "</td><td> </td><td >" + allhitaward + "</td><td >" + allhuishui + "</td><td >" + allyingkui + "</td><td> </td><td> </td></tr>", $("#" + cgDetail.divname).append(html)),
        dlist = "",
        html = ""
    },
    detailPrint: function(html, ttt) {
        var html = '<table class="alertsPrint1" width="100%" align="center">  <tbody><tr><td width="10%">彩种</td><td width="20%">注单编号</td><td width="*">下单时间</td><td width="10%">号码</td><td width="10%">金额</td><td width="10%">赔率</td><td width="10%">状态</td></tr>' + html + "</tbody></table>";
        return jAlertPrint(html, ttt,
        function() {}),
        html = "",
        !1
    },
    selectsoclass: function() {
        var soclassarr = ["赔率", "金额", "退码"];
        $.each(soclassarr,
        function(i) {
            $("#soclass").val() || $("#soclass").val(soclassarr[i]),
            $("#soclass").append("<option value='" + i + "'>" + soclassarr[i] + "</option>")
        })
    },
    so_s_class_s: 0,
    so_s_classid: function(classlist) {
        if (0 == cgDetail.so_s_class_s) {
            cgDetail.so_s_class_s = 1,
            $("#so_s_classid").append("<option value='0'>全部</option>"),
            $.each(classlist,
            function(i) {
                var cid = (classlist[i].pid, classlist[i].cid);
                $("#so_s_classid").append("<option value='" + cid + "'>" + classlist[i].n + "</option>")
            });
            var setlist = {
                10001 : "二定",
                10002 : "快打",
                10003 : "快选",
                10004 : "导入",
                10008 : "网",
                10009 : "虫",
                10010 : "手"
            };
            $.each(setlist,
            function(i) {
                $("#so_s_classid").append("<option value='" + i + "'>" + setlist[i] + "</option>")
            })
        }
    },
    s_number: "",
    s_issueno: 0,
    sizixian: 0,
    soclass: 0,
    s_money: 0,
    s_money_end: 0,
    s_classid: 0,
    setVal: function() {
        _self = this,
        _self.s_number = $("#detailsearchnumber").val(),
        _self.s_issueno = $("#ds_s_issueno").text();
        var sizixian = $("#detailsearchsendsizi").prop("checked");
        _self.sizixian = sizixian ? 1 : 0,
        _self.soclass = $("#soclass").val(),
        _self.s_money = $("#ds_s_money").val(),
        _self.s_money_end = $("#ds_s_money_end").val(),
        _self.s_classid = $("#so_s_classid").val()
    },
    setValInit: function() {
        _self = this,
        $("#detailsearchnumber").val(""),
        $("#ds_s_issueno").text(0),
        $("#detailsearchsendsizi").prop("checked", !1),
        $("#soclass").val(""),
        $("#ds_s_money").val(""),
        $("#ds_s_money_end").val(""),
        $("#so_s_classid").val("")
    },
    setSearch: function() {
        return cgDetail.setVal(),
        "&s_number=" + cgDetail.s_number + "&s_issueno=" + cgDetail.s_issueno + "&sizixian=" + cgDetail.sizixian + "&soclass=" + cgDetail.soclass + "&s_money=" + cgDetail.s_money + "&s_money_end=" + cgDetail.s_money_end + "&s_classid=" + cgDetail.s_classid
    },
    Tuima: function() {
        var strid = "";
        strid = $("#DetailList input[type=checkbox]").checkedValue(),
        "" == strid || jsonAjax("/index.php/Index/tuima", "POST", "action=ordertuima&tuimaid=" + strid, "json", cgDetail.funcTuima)
    },
    funcTuima: function(data) {
        var json = eval(data);
        if(json.code==200){
            var p=$('input[name="pageinput"]').val();
                var xian=0;
                var haoma=$('#detailsearchnumber').val();
                    xian=$('input[name="detailsearchsendsizi"]:checked').val();
                var type=$('select[name="soclass"] option:selected').val();
                var types=$('select[name="so_s_classid"] option:selected').val();
                var qishu=$('input[name="qishu"]').val();
                var ks1=$('input[name="ds_s_money"]').val();
                var ks2=$('input[name="ds_s_money_end"]').val();
            jsonAjax("./xiazhumingxi","get", 'p='+p+'&haoma='+haoma+'&type='+type+'&xian='+xian+'&types='+types+'&ks1='+ks1+'&ks2='+ks2+'&qishu='+qishu+"&action=soonorder"+ "&time=" + new Date().getMilliseconds(), "json", cgDetail.funcTuimas);
             
            leftprint.location.reload();
            
             //return $(window.frames.leftprint.document);
        }
        // var json = eval(data),
        // s = json.s;
        // if (s > 9e3) jAlert(json.m + "", "提示框",
        // function() {
        //     cgOrber.logout()
        // });
        // else if (s > 8e3);
        // else if (200 == s) {
        //     var get_credits_use = json.credits_use - 0,
        //     get_credits_use = Number(get_credits_use.toFixed(2));
        //     getUserInfo.setInfo(get_credits_use, json.credits_remaining),
        //     $("#DetailList input[type=checkbox]").checkedDetailTuima(),
        //     jsonAjax("appindexajax.php", "get", "action=soonorder", "json", cgOrber.GetSoonOrder)
        // }
    },
    funcTuimas: function(msg){
                     var data=msg['data'];
                     var code=msg['code'];
                     var html='',moneys=0,sum=0,wins2=0,wins3=0,moneys1=0;
                     $('input[name="qishu"]').val(msg.qishu);
                     $('#ds_title').text('第'+msg.qishu+'期 下注明细');
                    if(code==200){

                        for(var i=0;i<data.length;i++){
                            if(data[i]['js']==0){
                                
                                html+='<tr><td>七星彩</td><td>'+data[i]['did']+'</td><td>'+data[i]['addtime']+'</td><td class="number">'+data[i]['mingxi_2']+'<span>'+data[i]['mingxi_3']+'</span></td><td class="money">'+data[i]['money']+'</td><td class="frank">'+data[i]['odds']+'</td>';
                                  
                                if(data[i]['status']==1){
                                    html+='<td>'+data[i]['zj']+'</td>';
                                }else{
                                    html+='<td>--</td>';
                                }
                                html+='<td>'+data[i]['win']+'</td><td>'+data[i]['yingkui']+'</td><td>成功</td><td><input id="checkboxID'+data[i]['id']+'" type="checkbox" value="'+data[i]['id']+'"></td></tr>';
                                

                                moneys+=parseFloat(data[i]['money']);
                                wins2+=parseFloat(data[i]['win']);
                                moneys1+=parseFloat(data[i]['zj']);
                                wins3+=parseFloat(data[i]['yingkui']);
                                sum+=1;
                            }else{
                                var wins=data[i]['money']-data[i]['win'];
                                html+='<tr class="tuima"><td>七星彩</td><td>'+data[i]['did']+'</td><td>10-20 11:36:48<br>退'+data[i]['addtime']+'</td><td class="number">'+data[i]['mingxi_2']+'<span>'+data[i]['mingxi_3']+'</span></td><td class="money">'+data[i]['money']+'</td><td class="frank">'+data[i]['odds']+'</td><td>--</td><td>'+data[i]['win']+'</td><td>-'+wins+'</td><td>退码</td><td>--</td></tr>';
                            }
                        }

                        html+='<tr id="detailheji"><td colspan="2">合计</td><td>'+sum+'</td><td> </td><td>'+moneys.toFixed(2)+'</td><td> </td><td>'+moneys1.toFixed(2)+'</td><td>'+wins2.toFixed(3)+'</td><td>'+wins3.toFixed(3)+'</td><td> </td><td> </td></tr>';
                        //     if(data[i]['js']==0){
                        //         var wins1=data[i]['money']-data[i]['win'];
                        //         html+='<tr><td>七星彩</td><td>'+data[i]['did']+'</td><td>'+data[i]['addtime']+'</td><td class="number">'+data[i]['mingxi_2']+'<span>'+data[i]['mingxi_3']+'</span></td><td class="money">'+data[i]['money']+'</td><td class="frank">'+data[i]['odds']+'</td>';
                        //         if(data[i]['status']==1){
                        //             //console.log(data[i]['money']);
                        //             html+='<td>'+data[i]['money']+'</td>';
                        //             moneys1+=parseFloat(data[i]['money']);
                        //         }else{
                        //             html+='<td>--</td>';
                        //         }

                        //         html+='<td>'+data[i]['win']+'</td><td>-'+wins1+'</td><td>成功</td><td><input id="checkboxID'+data[i]['id']+'" type="checkbox" value="'+data[i]['id']+'"></td></tr>';

                        //         moneys+=parseFloat(data[i]['money']);
                        //         wins2+=parseFloat(data[i]['win']);
                        //         wins3+=parseFloat(data[i]['money'])-parseFloat(data[i]['win']);
                        //         sum+=1;
                        //     }else{
                        //         var wins=data[i]['money']-data[i]['win'];
                        //         html+='<tr class="tuima"><td>七星彩</td><td>'+data[i]['did']+'</td><td>10-20 11:36:48<br>退'+data[i]['addtime']+'</td><td class="number">'+data[i]['mingxi_2']+'<span>'+data[i]['mingxi_3']+'</span></td><td class="money">'+data[i]['money']+'</td><td class="frank">'+data[i]['odds']+'</td><td>--</td><td>'+data[i]['win']+'</td><td>-'+wins+'</td><td>退码</td><td>--</td></tr>';
                        //     }
                            
                            
                        // }
                        // html+='<tr id="detailheji"><td colspan="2">合计</td><td>'+sum+'</td><td> </td><td>'+moneys.toFixed(2)+'</td><td> </td><td>'+moneys1.toFixed(2)+'</td><td>'+wins2.toFixed(2)+'</td><td>'+wins3.toFixed(2)+'</td><td> </td><td> </td></tr>';
                        $('#DetailList').html(html);
                        $('#DetailListPager').html(msg['show']);
                    }else{
                        $('#DetailList').html('<tr><td>没有数据</td></tr>');
                        $('#DetailListPager').html('');
                    }
            
              
    },
    init: function() {
        $("#detailsearchnumber").limitMoneyX(),
        $("#ds_s_money").limitMoneyPoint(),
        $("#ds_s_money_end").limitMoneyPoint(),
        this.selectsoclass(),
        $("#DetailcheckboxALLID").attr("checked", !1),
        $("#DetailcheckboxALLID").unbind("click").click(function() {
            1 == this.checked ? $("#DetailList input[type=checkbox]").checkBox("all") : $("#DetailList input[type=checkbox]").checkBox("none")
        }),
        $("#detailtuima").unbind("click").click(function() {
            cgDetail.Tuima()
        }),
        $("#detailprint").unbind("click").click(function() {
            var setsan = cgDetail.setSearch();
            jsonAjax("appindexajax.php", "get", "action=detail&doaction=detailprint&page=" + cgDetail.pages + setsan, "json", cgDetail.GetDetail)
        }),
        $("#detailsearch").unbind("click").click(function() {
            jsonAjax("appindexajax.php", "get", "action=detail" + cgDetail.setSearch(), "json", cgDetail.GetDetail)
        }),
        $("#detailhitaward").unbind("click").click(function() {
            jsonAjax("appindexajax.php", "get", "action=detail&doaction=award" + cgDetail.setSearch(), "json", cgDetail.GetDetail)
        })
    }
},
cgBill = {
    credits_remaining: 0,
    credits_use: 0,
    divname: "billList",
    GetBill: function(data) {
        var json = eval(data),
        s = json.s;
        s > 9e3 ? jAlert(data.m + "", "提示框",
        function() {
            cgOrber.logout()
        }) : s > 8e3 ? jAlert(data.m + "", "提示框",
        function() {}) : 200 == s ? (cgBill.billList(json.billitem), 1 == json.pages && cgBill.setPage(json.zallnum - 0, json.allpage - 0, json.numpage - 0)) : jAlert("未知错误", "提示框",
        function() {})
    },
    setPage: function(allnum, allpage, numpage) {
        if (0 == allnum) $("#DetailListPager").hide();
        else {
            var setsan = cgDetail.setSearch();
            $("#DetailListPager").show(),
            $("#DetailListPager").jqPaginator({
                totalCounts: allnum,
                totalPages: allpage,
                pageSize: numpage,
                visiblePages: 10,
                currentPage: 1,
                wrapper: "",
                onPageChange: function(num, type) {
                    jsonAjax("appindexajax.php", "get", "action=detail&page=" + num + setsan, "json", cgDetail.GetDetail)
                }
            })
        }
    },
    billList: function(dlist) {
        $("#" + cgBill.divname).empty(),
        $("#" + cgBill.divname).html("");
        var html = "",
        num = dlist.length - 1;
        0 != isNull(dlist) && $.each(dlist,
        function(ii, item) {
            var yanse = dlist[ii].s,
            d = dlist[ii].d,
            i = dlist[ii].i,
            c = dlist[ii].c,
            m = dlist[ii].m,
            hs = dlist[ii].hs,
            am = dlist[ii].am,
            zyk = dlist[ii].zyk;
            if (0 == isNull(i)) return ! 0;
            var css = "";
            1 == yanse && (css = 'class="red"'),
            void 0 == d && (d = "--"),
            num == ii ? (i = "合计", c = 0 == c ? "": c, m = 0 == m ? "": m, hs = 0 == hs ? "": hs, am = 0 == am ? "": am, zyk = 0 == zyk ? "": zyk, html = '<tr class="xiazhukuang2"><th colspan="2">' + i + "</th><th>" + c + "</th><th>" + m + "</th><th>" + hs + "</th><th>" + am + "</th><th >" + zyk + "</th></tr>") : html = "<tr><td>" + d + "</td><td " + css + '><a href="JavaScript:;" onclick="cgBill.listclick(' + i + ')">' + i + "</a></td><td>" + c + "</td><td>" + m + "</td><td>" + hs + "</td><td>" + am + "</td><td >" + zyk + "</td></tr>",
            $("#" + cgBill.divname).append(html)
        }),
        dlist = "",
        html = ""
    },
    listclick: function(i) {
        $("#tab_bill").hide(),
        $("#tab_detail").show(),
        $("#ds_s_issueno").text(i),
        //jsonAjax("./", "get", "action=detail&s_issueno=" + i, "json", cgDetail.GetDetail);
        jsonAjax("./xiazhumingxi","get", 'qishu='+i+"&action=soonorder"+ "&time=" + new Date().getMilliseconds(), "json", cgDetail.funcTuimas);
    },
    init: function() {}
},
cgAward = {
    credits_remaining: 0,
    credits_use: 0,
    divname: "awardList",
    GetAward: function(data) {
        var json = eval(data),
        s = json.s;
        s > 9e3 ? jAlert(data.m + "", "提示框",
        function() {
            cgOrber.logout()
        }) : s > 8e3 ? jAlert(data.m + "", "提示框",
        function() {}) : 200 == s ? cgAward.awardList(json.numberawarditem) : jAlert("未知错误", "提示框",
        function() {})
    },
    awardList: function(dlist) {
        $("#" + cgAward.divname).empty(),
        $("#" + cgAward.divname).html("");
        var html = "";
        dlist.length;
        2 == cgOrber.caizhongselect ? ($("#awardnumberstr th:eq(7)").hide(), $("#awardnumberstr th:eq(8)").hide()) : ($("#awardnumberstr th:eq(7)").show(), $("#awardnumberstr th:eq(8)").show()),
        0 != isNull(dlist) && $.each(dlist,
        function(ii, item) {
            var yanse = dlist[ii].stat,
            at = dlist[ii].at,
            is = dlist[ii].is,
            n0 = dlist[ii].n0,
            n1 = dlist[ii].n1,
            n2 = dlist[ii].n2,
            n3 = dlist[ii].n3,
            n4 = dlist[ii].n4,
            n5 = dlist[ii].n5,
            n6 = dlist[ii].n6,
            css = "";
            1 == yanse ? (css = 'class="periodImg periodImg_5"', null == n0 && (n0 = n1 = n2 = n3 = n4 = n5 = n6 = "")) : css = 'class="periodImg periodImg_1"';
            var czhtml = "";
            2 == cgOrber.caizhongselect || (czhtml = "<td ><div " + css + ">" + n5 + "</div></td><td ><div " + css + ">" + n6 + "</div></td>"),
            html = "<tr><td>" + at + "</td><td>" + is + "</td><td><div " + css + ">" + n0 + "</div></td><td><div " + css + ">" + n1 + "</div></td><td><div " + css + ">" + n2 + "</div></td><td ><div " + css + ">" + n3 + "</div></td><td ><div " + css + ">" + n4 + "</div></td>" + czhtml + "</tr>",
            $("#" + cgAward.divname).append(html)
        }),
        dlist = "",
        html = ""
    },
    listclick: function(i) {
        $("#tab_bill").hide(),
        $("#tab_detail").show(),
        $("#ds_s_issueno").text(i),
        jsonAjax("appindexajax.php", "get", "action=detail&s_issueno=" + i, "json", cgDetail.GetDetail)
    },
    init: function() {}
},
cgLogs = {
    credits_remaining: 0,
    credits_use: 0,
    logsclass: {
        1 : "二定位",
        2 : "三定位",
        3 : "四定位",
        4 : "二字现",
        5 : "三字现",
        6 : "四字现"
    },
    divname: "logsList",
    GetLogs: function(data) {
        var json = eval(data),
        s = json.s;
        s > 9e3 ? jAlert(data.m + "", "提示框",
        function() {
            cgOrber.logout()
        }) : s > 8e3 ? jAlert(data.m + "", "提示框",
        function() {}) : 200 == s ? (cgLogs.LogsList(json.logItems), cgLogs.pages = json.pages, cgLogs.classid = json.classid, 1 == json.pages && cgLogs.setPage(json.zallnum - 0, json.allpage - 0, json.numpage - 0)) : jAlert("未知错误", "提示框",
        function() {})
    },
    setPage: function(allnum, allpage, numpage) {
        0 == allnum ? $("#logsListPager").hide() : ($("#logsListPager").show(), $("#logsListPager").jqPaginator({
            totalCounts: allnum,
            totalPages: allpage,
            pageSize: numpage,
            visiblePages: 10,
            currentPage: 1,
            wrapper: "",
            onPageChange: function(num, type) {
                jsonAjax("appindexajax.php", "get", "action=logs&page=" + num + "&classid=" + cgLogs.classid, "json", cgLogs.GetLogs)
            }
        }))
    },
    LogsList: function(dlist) {
        $("#" + cgLogs.divname).empty(),
        $("#" + cgLogs.divname).html("");
        var html = "";
        dlist.length;
        0 != isNull(dlist) && $.each(dlist,
        function(ii, item) {
            var id = dlist[ii].id,
            cy = dlist[ii].cy,
            bs = dlist[ii].bs,
            m = dlist[ii].m,
            str = dlist[ii].str,
            dt = dlist[ii].dt;
            cystat = 1 == cy ? "checked": "",
            cytext = '<input id="checy' + id + '" type="checkbox" ' + cystat + ' value="' + id + '" onclick="cgLogs.getCheVal(this)"/><input id="cyid' + id + '" type="hidden" />',
            html = "<tr><td>" + bs + "</td><td>" + m + "</td><td>" + str + "</td><td>" + dt + '</td><td class="center"><button class="btn btnTuima" id="LogsCy" type="button"  onclick="cgLogs.selectimport(' + id + ');return false;">生成</button></td><td class="center">' + cytext + "</td></tr>",
            $("#" + cgLogs.divname).append(html)
        }),
        dlist = "",
        html = ""
    },
    getCheVal: function(t) {
        var v = t.value,
        s = 0;
        t.checked && (s = 1),
        $("#cyid" + v).val(s + "-" + v)
    },
    getCyId: function() {
        var str = [],
        comm = "";
        return $("#logsList input[type=hidden]").each(function() {
            $(this).val() && (str += comm + $(this).val(), comm = "|")
        }),
        str
    },
    selectimport: function(id) {
        cgSelect.logid = id,
        $(".top_kaida li [rel=tab_kuaixuan]").click()
    },
    LogsCy: function() {
        var strid = "";
        strid = this.getCyId(),
        "" == strid || jsonAjax("appindexajax.php", "POST", "action=logs&doaction=editCy&logcyid=" + strid + "&classid=" + cgLogs.classid, "json", cgLogs.GetLogs)
    },
    classid: 0,
    pages: 0,
    LogsClass: function(t, id) {
        $("#logsclass").find("a").removeClass("active"),
        $(t).addClass("active"),
        cgLogs.classid = id,
        jsonAjax("appindexajax.php", "POST", "action=logs&classid=" + id, "json", cgLogs.GetLogs)
    },
    init: function() {
        var html = "";
        $.each(this.logsclass,
        function(ii, item) {
            html += '<a  href="JavaScript:;" onclick="cgLogs.LogsClass(this,' + ii + ');">' + item + "</a>&nbsp;&nbsp;"
        }),
        html += '<a href="JavaScript:;" onclick="cgLogs.LogsClass(this,0);">全部</a>&nbsp;&nbsp;',
        $("#logsclass").html(html),
        $("#LogsCy").unbind("click").click(function() {
            cgLogs.LogsCy()
        })
    }
},
cgPass = {
    credits_remaining: 0,
    credits_use: 0,
    divname: "passList",
    teshupasswd: "",
    GetPass: function(data) {
        var json = eval(data),
        s = json.s;
        s > 9e3 ? jAlert(data.m + "", "提示框",
        function() {
            cgOrber.logout()
        }) : s > 8e3 ? jAlert(data.m + "", "提示框",
        function() {}) : 200 == s ? (cgPass.teshupasswd = json.teshupasswd, $("#oldpassword").val(""), $("#newpassword").val(""), $("#newpassword2").val(""), $("#oldpassword").focus().select(), cgPass.passList(json.teshupasswd)) : jAlert("未知错误", "提示框",
        function() {})
    },
    EditPass: function(data) {
        var json = eval(data),
        s = json.s;
        s > 9e3 ? jAlert(data.m + "", "提示框",
        function() {
            cgOrber.logout()
        }) : s > 8e3 ? jAlert(data.m + "", "提示框",
        function() {}) : 200 == s ? jAlert(data.m + "", "提示框",
        function() {
            cgOrber.logout()
        }) : jAlert("未知错误", "提示框",
        function() {})
    },
    passList: function(dlist) {
        $("#" + cgPass.divname).empty(),
        $("#" + cgPass.divname).html(""),
        void 0 != dlist && $("#" + cgPass.divname).html(dlist)
    },
    cachestr: function(s) {
        for (var str = cgPass.teshupasswd,
        strarr = str.split("，"), i = 0; i < strarr.length; i++) if (s == strarr[i]) return ! 0;
        return ! 1
    },
    listclick: function() {
        var o = $("#oldpassword").val(),
        n = $("#newpassword").val(),
        n2 = $("#newpassword2").val(),
        rfs = !1;
        return "" == o ? jAlert("请填写原密码！", "提示框",
        function() {
            $("#oldpassword").select()
        }) : "" == n ? jAlert("请填写新密码！", "提示框",
        function() {
            $("#newpassword").select()
        }) : cgPass.cachestr(n) ? jAlert("输入的新密码已经被系统禁止不可用密码！", "提示框",
        function() {
            $("#newpassword").select()
        }) : "" == n2 ? jAlert("请填写确认新密码！", "提示框",
        function() {
            $("#newpassword2").select()
        }) : n != n2 ? jAlert("输入的新密码和确认新密码必须一样！", "提示框",
        function() {
            $("#newpassword2").select()
        }) : (rfs = !0, jsonAjax("appindexajax.php", "post", "action=pass&oldpassword=" + o + "&newpassword=" + n + "&newpassword2=" + n2, "json", cgPass.EditPass)),
        rfs
    },
    init: function() {
        $("#editpass").unbind("click").click(function() {
            cgPass.listclick()
        }),
        $("#oldpassword").keypress(function(event) {
            13 == (event.keyCode ? event.keyCode: event.which) && $("#newpassword").focus().select()
        }),
        $("#newpassword").keypress(function(event) {
            13 == (event.keyCode ? event.keyCode: event.which) && $("#newpassword2").focus().select()
        }),
        $("#newpassword2").keypress(function(event) {
            13 == (event.keyCode ? event.keyCode: event.which) && $("#editpass").click()
        })
    }
},
cgErZiDing = {
    credits_remaining: 0,
    credits_use: 0,
    childid: 0,
    child_odd_tiptop: 0,
    child_money_least: 0,
    divname: "erzidingList",
    GetReZiDing: function(data) {
        var json = eval(data),
        s = json.s;
        s > 9e3 ? jAlert(data.m + "", "提示框",
        function() {
            cgOrber.logout()
        }) : 8884 == s ? ($("#tab_erziding").find("div").eq(0).show(), $("#tab_erziding").find("div").eq(1).hide()) : s > 8e3 ? jAlert(data.m + "", "提示框",
        function() {}) : 200 == s ? ($("#tab_erziding").find("div").eq(0).hide(), $("#tab_erziding").find("div").eq(1).show(), cgErZiDing.quxiaoClick(), cgErZiDing.credits_remaining = json.credits_remaining, cgErZiDing.credits_use = json.credits_use, cgErZiDing.child_odd_tiptop = json.child_odd_tiptop - 0, cgErZiDing.child_money_least = json.child_money_least - 0, cgErZiDing.erzidingList(json)) : jAlert("未知错误", "提示框",
        function() {})
    },
    erzidingList: function(json) {
        $("#" + cgErZiDing.divname).empty(),
        $("#" + cgErZiDing.divname).html("");
        var html = "",
        ziyou_frankcolor = json.ziyou_frankcolor,
        childitem = json.childitem,
        dlist = json.erzidingitem;
        cgErZiDing.childid = json.childid,
        cgOrber.erzimode = json.erzimode;
        var jsclassnameArr = new Array("仟", "佰", "拾", "个");
        0 != isNull(childitem) && $.each(childitem,
        function(ii, item) {
            var cn = childitem[ii].cn,
            gid = childitem[ii].id,
            css = "";
            if (cgErZiDing.childid == gid) {
                var css = 'class="active"';
                carr = cn.split("");
                var cc = 0;
                for (i = 0; i <= carr.length - 1; i++)"口" == carr[i] && 0 == cc ? ($("#rzd_qian").text(jsclassnameArr[i]), cc = 1) : "口" == carr[i] && 1 == cc && $("#rzd_shi").text(jsclassnameArr[i])
            }
            html += '<a href="JavaScript:cgErZiDing.childclick(' + gid + ')" ' + css + ">" + cn + "</a>&nbsp;&nbsp;"
        }),
        //$("#rdclassname").html(html),
        html = "";
        var num = 0;
        0 != isNull(dlist) && $.each(dlist,
        function(ii, item) {
            var n = dlist[ii].n,
            f = dlist[ii].f,
            spf = dlist[ii].spf,
            ls = " h";
            if (ziyou_frankcolor > 0 && ziyou_frankcolor > spf && (ls = " l"), num++, 1 == num && (html = "<tr>", 1 != cgOrber.erzimode && (html += '<td class="rdcol"></td>')), 1 == cgOrber.erzimode) html += '<td><div class="rdL"><span class="' + ls + '">' + f + "</span><br>" + n + '</div><div class="rdR"><input type="text" id="ezdm' + n + '" maxlength=5/></div></td>';
            else {
                var k = dlist[ii].k;
                html += '<td id="e' + (ii < 10 ? "0" + k: k) + '" onclick="cgErZiDing.ezdC(this);"><div class="rdL">' + n + '</div><div class="rdR' + ls + '">' + f + "</div></td>"
            }
            10 == num && (html += "</tr>", num = 0, $("#" + cgErZiDing.divname).append(html))
        }),
        1 == cgOrber.erzimode ? cgErZiDing.keydownNext() : cgErZiDing.SanJiao(),
        dlist = "",
        childitem = "",
        html = ""
    },
    ezdC: function(t) {
        $(t).is(".success") ? ($(t).removeClass("success"), cgErZiDing.mBiShu < 0 ? cgErZiDing.mBiShu = 0 : cgErZiDing.mBiShu--) : ($(t).addClass("success"), cgErZiDing.mBiShu++),
        $("#rdcount").text(cgErZiDing.mBiShu);
        var m = $("#erzidingmoney").val();
        //$("#rdmoney").text(cgErZiDing.mBiShu * m)
    },
    ezdJ: function(t) {
        $(t).is(".active") ? $(t).removeClass("active") : $(t).addClass("active");
        var ct = [44, 55];
        for (i = 0; i <= 9; i++) for (j = 0; j <= 9; j++) {
            chCodeA = 0,
            no = i + "" + j;
            for (var k in ct) {
                if (1 == chCodeA) break;
                var ctt = $("#ct" + ct[k]);
                $(ctt).is(".active") && (44 == ct[k] && eval(i + j) % 2 == 1 ? chCodeA = 1 : 55 == ct[k] && eval(i + j) % 2 != 1 && (chCodeA = 1))
            }
            0 == chCodeA && (qCarChkA = 0, qCarChkB = 0, $("#erziding_qian").find("button").each(function() {
                if ($(this).is(".active")) {
                    var n = $(this).attr("data");
                    n <= 9 && i == n ? qCarChkA = 1 : 10 == n && i % 2 == 1 ? qCarChkA = 1 : 11 == n && i % 2 == 0 ? qCarChkA = 1 : 12 == n && i >= 5 ? qCarChkA = 1 : 13 == n && i <= 4 && (qCarChkA = 1)
                }
            }), $("#erziding_shi").find("button").each(function() {
                if ($(this).is(".active")) {
                    var n = $(this).attr("data");
                    n <= 9 && j == n ? qCarChkB = 1 : 10 == n && j % 2 == 1 ? qCarChkB = 1 : 11 == n && j % 2 == 0 ? qCarChkB = 1 : 12 == n && j >= 5 ? qCarChkB = 1 : 13 == n && j <= 4 && (qCarChkB = 1)
                }
            }), 1 == qCarChkA && 1 == qCarChkB && (chCodeA = 1)),
            0 == chCodeA && $("#erziding_hf0").find("button").each(function() {
                if ($(this).is(".active")) {
                    var n = $(this).attr("data");
                    eval(i + j) % 10 == n && (chCodeA = 1)
                }
            }),
            0 == chCodeA && $("#erziding_hf1").find("button").each(function() {
                if ($(this).is(".active")) {
                    var n = $(this).attr("data");
                    eval(i + j) % 10 == n && (chCodeA = 1)
                }
            }),
            obj = $("#e" + no),
            1 == chCodeA ? (obj.is(".success") || cgErZiDing.mBiShu++, obj.addClass("success")) : (obj.is(".success") && (cgErZiDing.mBiShu < 0 ? cgErZiDing.mBiShu = 0 : cgErZiDing.mBiShu--), obj.removeClass("success"))
        }
        $("#rdcount").text(cgErZiDing.mBiShu);
        var m = $("#erzidingmoney").val();
        //$("#rdmoney").text(cgErZiDing.mBiShu * m)
    },
    SanJiao: function() {
        $(".rdrow").find("th").each(function() {
            $(this).unbind("click").click(function() {
                var ii = $(this).index();
                $("#" + cgErZiDing.divname + " tr").find("td:eq(" + ii + ")").each(function() {
                    $(this).is(".rdcol") || $(this).click()
                })
            })
        }),
        $("#" + cgErZiDing.divname).find(".rdcol").each(function() {
            $(this).unbind("click").click(function() {
                $(this).parent("tr").find("td").each(function() {
                    $(this).is(".rdcol") || $(this).click()
                })
            })
        })
    },
    quxiaoClick: function() {
        cgErZiDing.mBiShu = 0,
        $("#" + cgErZiDing.divname).find("td").each(function() {
            $(this).is(".success") && $(this).removeClass("success")
        }),
        $("#erziding_qian").find("button").each(function() {
            $(this).removeClass("active")
        }),
        $("#erziding_shi").find("button").each(function() {
            $(this).removeClass("active")
        }),
        $("#erziding_hf0").find("button").each(function() {
            $(this).removeClass("active")
        }),
        $("#erziding_hf1").find("button").each(function() {
            $(this).removeClass("active")
        }),
        $("#rdcount").text(0),
        $("#rdmoney").text(0),
        $("#erzidingmoney").val("")
    },
    dingweiHtml: function(id) {
        var dingwei = new Array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "单", "双", "大", "小"),
        html = "";
        for (i = 0; i < dingwei.length; i++) html += '<button class="btn b" id="dw' + i + '" data="' + i + '" type="button" onclick="cgErZiDing.ezdJ(this);">' + dingwei[i] + "</button>";
        return html
    },
    hefen4: new Array("0", "1", "2", "3", "4"),
    hefen9: new Array("5", "6", "7", "8", "9"),
    hefenHtml: function(id) {
        var hefen = 44 == id ? cgErZiDing.hefen4: cgErZiDing.hefen9,
        html = "";
        for (i = 0; i < hefen.length; i++) html += '<button class="btn b" id="hf' + hefen[i] + '" data="' + hefen[i] + '" type="button" onclick="cgErZiDing.ezdJ(this);">' + hefen[i] + "</button>";
        return html += 44 == id ? '<button class="btn b" id="ct' + id + '" type="button" onclick="cgErZiDing.ezdJ(this);">单</button>': '<button class="btn b" id="ct' + id + '" type="button" onclick="cgErZiDing.ezdJ(this);">双</button>'
    },
    childclick: function(id) {
        cgErZiDing.mBiShu = 0,
        $("#rdcount").text(0),
        $("#rdmoney").text(0),
        jsonAjax("./erziding", "get", "action=erziding&childid=" + id, "json", cgErZiDing.GetReZiDing)
    },
    keydownNext: function(t) {
        $("#" + cgErZiDing.divname + " input:text:first").focus(),
        $("#" + cgErZiDing.divname + " input:text").bind("keydown",
        function(e) {
            if (13 == e.which) {
                e.preventDefault();
                var nextinput = $("#" + cgErZiDing.divname + " input:text")[$("#" + cgErZiDing.divname + " input:text").index(this) + 1];
                void 0 != nextinput ? nextinput.focus() : $("#serziding_but1").click()
            }
        }),
        $("#" + cgErZiDing.divname + " input:text").bind("keyup",
        function(e) {
            var t = $(this);
            t.val(t.val().replace(/[^0-9.]/g, ""));
            var m_bj = t.val() - 0;
            m_bj > cgErZiDing.child_odd_tiptop ? jAlert(m_bj + "填写的金额不能超出单注上限" + cgErZiDing.child_odd_tiptop + "!", "提示框",
            function() {
                t.val(""),
                t.focus()
            }) : m_bj > 0 && m_bj < cgErZiDing.child_money_least && jAlert("填写金额不能小于" + cgErZiDing.child_money_least + "!", "提示框",
            function() {
                t.val(""),
                t.focus()
            });
            var num = 0,
            m = 0;
            $("#" + cgErZiDing.divname + " input:text").each(function() {
                var v = $(this).val() - 0;
                v > 0 && (m = cgCheckSend.FloatAdd(m, v), num += 1)
            }),
            $("#rdcount").text(num);
           // $("#rdmoney").text(Number(m.toFixed(2)))
        })
    },
    mMoney: 0,
    mBiShu: 0,
    mNumber: "",
    getNumber: function() {
        var strnumber = "",
        comm = "";
        return cgErZiDing.mBiShu = 0,
        $("#" + cgErZiDing.divname).find("td").each(function() {
            if (1 == cgOrber.erzimode) {
                var o = $(this).find(".rdR input"),
                m = o.val();
                if (m > 0) {
                    var nstr = o.prop("id"),
                    n = nstr.substr(4, 4);
                    strnumber += comm + n + "|" + m,
                    comm = ","
                }
            } else if ($(this).is(".success")) {
                var n = $(this).children(".rdL").text();
                "" != n && (strnumber += comm + n, comm = ",", cgErZiDing.mBiShu++)
            }
        }),
        strnumber
    },
    sendNumber: function() {
        this.mNumber = this.getNumber(),
        allmoney = $("#rdmoney").text() - 0,
        allcount = Math.floor($("#rdcount").text() - 0),
        cgSelect.getNumberCount = allcount;
        var send = !0;
        if (1 == cgOrber.erzimode) 0 == isNull(this.mNumber) ? (jAlert("请填写金额，再次下注！", "提示框",
        function() {
            return $("#" + cgErZiDing.divname + " input:text:first").focus(),
            !1
        }), send = !1) : allmoney <= 0 && (jAlert("请填写的金额!", "提示框",
        function() {
            t.focus()
        }), send = !1),
        cgSelect.mMoney = "";
        else {
            var t = $("#erzidingmoney"),
            m_bj = t.val() - 0;
            0 == isNull(this.mNumber) ? (jAlert("请点击选中号码，再次下注！", "提示框",
            function() {
                return ! 1
            }), send = !1) : m_bj <= 0 || allmoney <= 0 ? (jAlert("请填写的金额!", "提示框",
            function() {
                t.focus()
            }), send = !1) : m_bj > cgErZiDing.child_odd_tiptop ? (jAlert(m_bj + " 填写的金额不能超出单注上限" + cgErZiDing.child_odd_tiptop + "!", "提示框",
            function() {
                t.val(""),
                t.focus()
            }), send = !1) : m_bj > 0 && m_bj < cgErZiDing.child_money_least && (jAlert(m_bj + "填写金额不能小于" + cgErZiDing.child_money_least + "!", "提示框",
            function() {
                t.val(""),
                t.focus()
            }), send = !1),
            cgSelect.mMoney = m_bj
        }
        cgErZiDing.credits_remaining <= 0 || allmoney > cgErZiDing.credits_remaining ? (jAlert("信用额度不足！", "提示框",
        function() {
            return ! 1
        }), send = !1) : send && ($("#rdcount").text(0), $("#rdmoney").text(0), $("#erzidingmoney").val(""), cgSelect.lujingstat = 1, cgSelect.mNumber = this.mNumber, cgSelect.xian = 0, $("#selectlogsclassid").val(1), $("#selectnumbertotal_hidden").val(allcount), $("#selectlogs").val(""), cgSelect.strarray = "", cgSelect.SendSoonSelectInit())
    },
    moshi: function(s, stat) {
        cgErZiDing.mBiShu = 0,
        $("#rdcount").text(0),
        $("#rdmoney").text(0);
         var str = "";
        // 1 == stat && (s = 1 == s ? 2 : 1, str = "&erzimode=" + s),
        1 == s ? ($("#moshi").val(1), $("#moshi").text("模式1"), $("#erzidingcanshu").hide(), $("#erzidingqueding").show(), $(".rdrow").hide(), $(".rdImgtitle td").hide(), $(".rdImgtitle").find(".rdR").text("金额")) : ($("#moshi").val(2), $("#moshi").text("模式2"), $("#erzidingcanshu").show(), $("#erzidingqueding").hide(), $(".rdrow").show(), $(".rdImgtitle td").show(), $(".rdImgtitle").find(".rdR").text("赔率")),
        jsonAjax("./erziding", "get", "action=erziding" + str + "&childid=" + cgErZiDing.childid, "json", cgErZiDing.GetReZiDing)
    },
    init: function() {
        $("#erziding_qian").html('<span id="rzd_qian">仟</span>' + cgErZiDing.dingweiHtml(1)),
        $("#erziding_shi").html('<span id="rzd_shi">拾</span>' + cgErZiDing.dingweiHtml(2)),
        $("#erziding_hf0").html("" + cgErZiDing.hefenHtml(44)),
        $("#erziding_hf1").html("" + cgErZiDing.hefenHtml(55)),
        $("#serziding_but").unbind("click").click(function() {
            cgErZiDing.sendNumber()
        }),
        $("#serziding_quxiao").unbind("click").click(function() {
            cgErZiDing.quxiaoClick()
        }),
        $("#erzidingmoney").keyup(function() {
            cgErZiDing.getNumber();
            var bs = cgErZiDing.mBiShu,
            m = $(this).val().replace(/[^0-9.]/g, "");
            $("#rdcount").text(bs);
            //$("#rdmoney").text(bs * m)
        }),
        $("#erzidingmoney").limitMoneyPoint(),
        $("#erzidingmoney").bind("keydown",
        function(e) {
            13 == e.which && (e.preventDefault(), cgErZiDing.sendNumber())
        }),
        $("#serziding_but1").unbind("click").click(function() {
            cgErZiDing.sendNumber()
        }),
        $("#moshi").unbind("click").click(function() {
            var m = $("#moshi").val();
            cgErZiDing.moshi(m, 1)
        })
    }
},
cgFrankHot = {
    credits_remaining: 0,
    credits_use: 0,
    s_classid: 0,
    divname: "frankList",
    GetFrank: function(data) {
        var json = eval(data),
        s = json.s;
        s > 9e3 ? jAlert(data.m + "", "提示框",
        function() {
            cgOrber.logout()
        }) : s > 8e3 ? jAlert(data.m + "", "提示框",
        function() {}) : 200 == s ? (cgFrankHot.s_classid = json.s_classid, cgFrankHot.frankName(json.classnamestr), cgFrankHot.frankList(json)) : jAlert("未知错误", "提示框",
        function() {})
    },
    frankName: function(dlist) {
        var html = "";
        0 != isNull(dlist) && $.each(dlist,
        function(ii, item) {
            var css = "";
            if (cgFrankHot.s_classid == ii) var css = 'class="active"';
            html += '<a href="JavaScript:;" onclick="cgFrankHot.cn(' + ii + ')" ' + css + ">" + dlist[ii] + "</a>&nbsp;&nbsp;"
        }),
        $("#frankhotname").html(html),
        dlist = "",
        html = ""
    },
    frankList: function(json) {
        var cname = json.classnamechild,
        dlist = json.frankhotitem;
        $("#" + cgFrankHot.divname).empty(),
        $("#" + cgFrankHot.divname).html("");
        0 != isNull(dlist) && $.each(dlist,
        function(ii, item) {
            var html = "";
            for (void 0 != cname[ii] && (html += '<tr class="xiazhukuang2"><td colspan=10><b>' + cname[ii] + "</b></td></tr>"), html += '<tr class="xiazhukuang2">', l = 1; l <= 5; l++) {
                var tdc = "";
                l % 2 == 0 && (tdc = 'class="fh"'),
                html += "<td " + tdc + ">号码</td><td " + tdc + ">赔率</td>"
            }
            html += "</tr>";
            var num = 1,
            total = 0;
            if ($.each(dlist[ii],
            function(jj, itemjj) {
                var n = dlist[ii][jj].n,
                f = dlist[ii][jj].f;
                1 == num && (html += "<tr>"),
                tdc = "",
                num % 2 == 0 && (tdc = 'class="fh"'),
                html += "<td " + tdc + ">" + n + "</td><td " + tdc + ">" + f + "</td>",
                5 == num && (html += "</tr>", num = 0),
                num++,
                total++,
                5 == total && (total = 0)
            }), total > 0 && total < 5) for (j = total; j < 5; j++) tdc = "",
            j % 2 == 1 && (tdc = 'class="fh"'),
            html += "<td " + tdc + ">--</td><td " + tdc + ">--</td>",
            4 == j && (html += "</tr>", num = 0);
            $("#" + cgFrankHot.divname).append(html)
        }),
        dlist = "",
        html = "",
        cname = ""
    },
    cn: function(i) {
        jsonAjax("appindexajax.php", "get", "action=frankhot&s_classid=" + i, "json", cgFrankHot.GetFrank)
    },
    init: function() {}
},
cgImport = {
    credits_use_all: 0,
    credits_remaining: 0,
    credits_use: 0,
    sizixian: 0,
    showstat: 0,
    sntxt: 0,
    olstat: 0,
    olstr: "",
    olnumber: "",
    f_array: "",
    divname: "importList",
    GetImport: function(data) {
        var json = eval(data),
        s = json.s;
        s > 9e3 ? jAlert(data.m + "", "提示框",
        function() {
            cgOrber.logout()
        }) : s > 8e3 ? jAlert(data.m + "", "提示框",
        function() {}) : 200 == s ? "importprint" == json.joaction ? cgImport.importPrint(json) : cgImport.importList(json) : jAlert("未知错误", "提示框",
        function() {})
    },
    setPage: function(allnum, numpage, page) {
        0 == allnum ? $("#PrintPager").hide() : ($("#PrintPager").show(), $("#PrintPager").jqPaginator({
            totalCounts: allnum,
            pageSize: numpage,
            visiblePages: 10,
            currentPage: page,
            wrapper: "",
            onPageChange: function(num, type) {
                jsonAjax("appindexajax.php", "get", "action=import&doaction=init&joaction=importprint&page=" + num, "json", cgImport.GetImport)
            }
        }))
    },
    importPrint: function(json) {
        var dlist = json.importitem,
        trs = json.trs,
        html = "",
        num = 1,
        allm = 0;
        0 != isNull(dlist) && $.each(dlist,
        function(ii, item) {
            if (!isNull(dlist[ii])) return ! 0;
            var s = dlist[ii].s,
            sizitext = "";
            if (0 != isNull(s) && (sizitext = "<span>现</span>"), 1 == num && (html += "<tr>"), 1 == trs) {
                var n = dlist[ii].n,
                m = dlist[ii].m;
                html += "<td>" + n + sizitext + "=" + m + "</td>",
                allm = cgCheckSend.FloatAdd(allm, m)
            } else html += "<td>" + dlist[ii] + sizitext + "</td>";
            8 == num && (html += "</tr>", num = 0),
            num++
        });
        var date = new Date,
        month = date.getMonth() + 1,
        day = date.getDate();
        return allm = Number(allm.toFixed(2)),
        html += '<tr><td  style="border-top:1px solid #000000;height:28px;line-height:19px;" colspan="8">&nbsp;&nbsp;&nbsp;&nbsp;合计:' + allm + "</td></tr>",
        html = '<table class="alertsPrint1 alertsPrint2" width="100%" align="center"><tbody>' + html + "</tbody></table>",
        jAlertPrint(html, "文件明细 " + month + "月" + day + "日",
        function() {}),
        dlist = "",
        html = "",
        json.zallnum - 0 > 1 && cgImport.setPage(json.zallnum - 0, json.numpage - 0, json.pages - 0),
        !1
    },
    importTr: function(t, numli) {
        var html = "",
        html2 = "";
        for (html += '<tr class="xiazhukuang2">', l = 1; l <= numli; l++) {
            var tdc = "";
            l % 2 == 0 && (tdc = 'class="fh"'),
            html2 = 1 == t ? "<td " + tdc + ">号码</td><td " + tdc + ">金额</td>": "<td " + tdc + ">号码</td>",
            html += html2
        }
        return html += "</tr>"
    },
    importList: function(json) {
        var dlist = json.importitem;
        if (cgImport.getNumber = "", cgImport.credits_remaining = json.credits_remaining, cgImport.credits_use = json.credits_use, cgImport.olstat = json.olstat, cgImport.olstr = json.olstr, cgImport.olnumber = json.olnumber, cgImport.sizixian = json.sizixian, cgImport.sntxt = json.sntxt, cgImport.showstat = json.showstat, cgSelect.getNumberCount = 0, $("#" + cgImport.divname).empty(), $("#" + cgImport.divname).html(""), 0 != isNull(dlist)) {
            var trs = json.trs,
            numli = 1 == trs ? 6 : 12;
            $("#" + cgImport.divname).append(this.importTr(trs, numli));
            var num = 1,
            total = 0,
            alltotal = 0,
            html = "",
            comm = "";
            if ($.each(dlist,
            function(ii, item) {
                var n = dlist[ii].n,
                x = dlist[ii].x,
                c = dlist[ii].c,
                sizitext = "";
                if (1 == x && (sizitext = "<span>现</span>"), 1 == num && (html += "<tr>"), tdc = "", num % 2 == 0 && (tdc = 'class="fh"'), html += '<td data="' + c + '" ' + tdc + ">" + n + sizitext + "</td>", 1 == trs) {
                    var m = dlist[ii].m;
                    html += "<td " + tdc + ">" + m + "</td>",
                    cgImport.getNumber += comm + "" + n + "|" + m
                } else cgImport.getNumber += comm + "" + n;
                num == numli && (html += "</tr>", num = 0),
                num++,
                total++,
                alltotal++,
                comm = ",",
                total == numli && (total = 0)
            }), cgSelect.getNumberCount = alltotal, total > 0 && total < numli) for (j = total; j < numli; j++) tdc = "",
            j % 2 == 1 && (tdc = 'class="fh"'),
            html += "<td " + tdc + ">--</td>",
            1 == trs && (html += "<td " + tdc + ">--</td>"),
            j == numli - 1 && (html += "</tr>", num = 0);
            if (1 == trs) var totalmoney = json.totalmoney;
            else var totalmoney = "";
            html += '<tr class="xiazhukuang2"><td ><b>合计笔数</b></td><td colspan=2 id="importbs">' + alltotal + "</td><td ><b>合计金额</b></td><td colspan=2 id=show_totalmoney>" + totalmoney + "</td><td colspan=6></td></tr>",
            $("#" + cgImport.divname).append(html),
            1 == trs ? ($("#import_t1").show(), $("#import_t2").hide(), $("#import_but1").focus()) : (cgImport.f_array = json.f_array, $("#import_t1").hide(), $("#import_t2").show(), $("#importmoney").select(), $("#importmoney").unbind("keyup").keyup(function() {
                cgImport.totalmoney($(this))
            }), $("#importmoney").limitMoneyPoint()),
            1 == cgImport.sntxt ? $(".import_sntxt").show() : $(".import_sntxt").hide(),
            1 == cgImport.showstat ? $("#import_t").show() : 1 == cgImport.sntxt ? ($("#import_t").show(), $("#import_t1").hide(), $("#import_t2").hide()) : $("#import_t").hide(),
            cgImport.trs = trs,
            $(".main_import").scrollTop($(".main_import")[0].scrollHeight)
        } else $("#import_t").hide(),
        $("#import_t1").hide(),
        $("#import_t2").hide(),
        cgImport.getNumber = "",
        cgImport.f_array = "",
        cgImport.olstat = 0,
        cgImport.olstr = "",
        cgImport.olnumber = "",
        cgImport.sizixian = 0;
        dlist = "",
        html = ""
    },
    totalmoney: function(t) {
        var m = t.val().replace(/[^0-9.]/g, ""),
        money = (m - 0) * ($("#importbs").text() - 0);
        money = Number(money.toFixed(2)),
        $("#show_totalmoney").text(money)
    },
    trs: 0,
    getNumber: "",
    sendNumber: function() {
        allmoney = $("#show_totalmoney").text() - 0,
        cgImport.credits_use_all = cgCheckSend.FloatAdd(cgImport.credits_use - 0, allmoney - 0),
        cgImport.setsendNumber()
    },
    setsendNumber: function() {
        var mNumber = cgImport.getNumber;
        allmoney = $("#show_totalmoney").text() - 0,
        allcount = Math.floor($("#importbs").text() - 0);
        var send = !0;
        if (1 == cgImport.trs) {
            var olstat = cgImport.olstat;
            0 == isNull(mNumber) ? (jAlert("还没有选择文件导入!", "提示框",
            function() {
                return ! 1
            }), send = !1) : 1 == olstat ? (jAlert(cgImport.olnumber + " 金额不能超出单注上限" + cgImport.olstr + "!", "提示框",
            function() {}), send = !1) : 2 == olstat ? (jAlert(cgImport.olnumber + " 金额不能小于" + cgImport.olstr + "!", "提示框",
            function() {}), send = !1) : 3 == olstat ? (jAlert(cgImport.olnumber + " 金额不能带小数点！", "提示框",
            function() {}), send = !1) : allmoney <= 0 && (jAlert("金额不能为空!", "提示框",
            function() {
                $("#importmoney").select()
            }), send = !1),
            cgSelect.mMoney = ""
        } else {
            var m = $("#importmoney").val();
            if (0 == isNull(m)) jAlert("请填写金额，再次下注！", "提示框",
            function() {
                return $("#importmoney").select(),
                !1
            }),
            send = !1;
            else if (0 == isNull(mNumber)) jAlert("还没有选择文件导入!", "提示框",
            function() {}),
            send = !1;
            else if (allmoney <= 0) jAlert("请填写的金额!", "提示框",
            function() {
                $("#importmoney").select()
            }),
            send = !1;
            else {
                var f = cgImport.f_array;
                mClassList = cgOrber.classList,
                $.each(f,
                function(ii, item) {
                    for (var classid = ii,
                    getmoney = (f[ii].m - 0) * m - 0, o = 0, l = 0, cid = 0, ollen = mClassList.length - 0, i = 0; i < ollen; i++) if (cid = mClassList[i].cid, cid == classid) {
                        o = mClassList[i].o - 0,
                        l = mClassList[i].l - 0;
                        break
                    }
                    var zuixiao = l,
                    s = 0;
                    if (getmoney > o ? (s = 1, cgCheckSend.moneymsg = o) : m < l ? (s = 2, cgCheckSend.moneymsg = l) : !cgCheckSend.isDian(zuixiao) && cgCheckSend.isDian(m) && (s = 3), s > 0) return cgCheckSend.showMoney(s,
                    function() {
                        $("#importmoney").select()
                    }),
                    send = !1,
                    !1
                })
            }
            cgSelect.mMoney = m
        }
        cgImport.credits_remaining <= 0 || allmoney > cgImport.credits_remaining ? (jAlert("信用额度不足！", "提示框",
        function() {
            return ! 1
        }), send = !1) : send && (cgSelect.lujingstat = 4, cgSelect.mNumber = mNumber, cgSelect.xian = cgImport.sizixian, $("#selectlogsclassid").val(0), $("#selectnumbertotal_hidden").val(allcount), $("#selectlogs").val(""), cgSelect.strarray = "", mNumber = "", cgImport.getNumber = "", $("#importmoney").val(""), cgSelect.SendSoonSelectInit())
    },
    updataFile: function() {
        return "" == $("#fileinput").val() ? jAlert("请选择文件！", "提示框",
        function() {
            return ! 1
        }) : ($("#fileinput_but").text("正在解析.."), $("#fileinput_but").attr("disabled", !0), $.ajaxFileUpload({
            url: "appindexajax.php?action=import",
            secureuri: !1,
            fileElementId: "fileinput",
            dataType: "json",
            complete: function() {},
            success: function(data, status) {
                cgImport.GetImport(data),
                $("#fileinput").val(""),
                $("#fileinput_but").removeAttr("disabled"),
                $("#fileinput_but").text("提交")
            },
            error: function(data, status, e) {
                $("#fileinput_but").removeAttr("disabled"),
                $("#fileinput_but").text("提交")
            }
        })),
        !1
    },
    init: function() {
        $("#fileinput_but").unbind("click").click(function() {
            jQuery.getScript("./admincg/javascript/ajaxfileupload.js").done(function() {
                cgImport.updataFile()
            }).fail(function() {
                jAlert("加载文件失败，请重新提交！", "提示框",
                function() {
                    return ! 1
                })
            })
        }),
        $("#importreset_but").unbind("click").click(function() {
            jsonAjax("appindexajax.php", "GET", "action=selectreset&stat=1", "json", cgImport.GetImport)
        }),
        $("#importprint_but").unbind("click").click(function() {
            jsonAjax("appindexajax.php", "GET", "action=import&doaction=init&joaction=importprint", "json", cgImport.GetImport)
        }),
        $("#import_but1").unbind("click").click(function() {
            cgImport.sendNumber()
        }),
        $("#import_but2").unbind("click").click(function() {
            cgImport.sendNumber()
        }),
        $("#import_but1").bind("keydown",
        function(e) {
            13 == e.which && cgImport.sendNumber()
        }),
        $("#importmoney").bind("keydown",
        function(e) {
            13 == e.which && cgImport.sendNumber()
        })
    }
},
ua = navigator.userAgent,
$IE = "Microsoft Internet Explorer" == navigator.appName,
$IE5 = $IE && ua.indexOf("MSIE 5") != -1,
$IE5_0 = $IE && ua.indexOf("MSIE 5.0") != -1,
$Gecko = ua.indexOf("Gecko") != -1,
$Safari = ua.indexOf("Safari") != -1,
$Opera = ua.indexOf("Opera") != -1,
$Mac = ua.indexOf("Mac") != -1,
$NS7 = ua.indexOf("Netscape/7") != -1,
$NS71 = ua.indexOf("Netscape/7.1") != -1,
window_img = "./admincg/images/";
$Opera && ($IE = !0, $Gecko = !1, $Safari = !1),
$IE5 && ($IE = !0, $Gecko = !1, $Safari = !1);
var $gv = $getValue,
$dom = {
    parseInt: function(s) {
        return null == s || "" == s || void 0 === s ? 0 : parseInt(s)
    },
    getClientSize: function(n) {
        if ($IE) {
            var s = {
                x: n.clientLeft,
                y: n.clientTop
            };
            return s.l = s.x,
            s.t = s.y,
            s.r = n.clientRight,
            s.b = n.clientBottom,
            s.w = n.clientWidth,
            s.h = n.clientHeight,
            s
        }
        var t = n.style;
        if (0 == t.borderLeftWidth.length || 0 == t.borderTopWidth.length || 0 == t.borderRightWidth.length || 0 == t.borderBottomWidth.length) {
            var l = n.offsetWidth;
            t.borderLeftWidth = "0px",
            l -= n.offsetWidth;
            var r = n.offsetWidth;
            t.borderRightWidth = "0px",
            r -= n.offsetWidth;
            var o = n.offsetHeight;
            t.borderTopWidth = "0px",
            o -= n.offsetHeight;
            var b = n.offsetHeight;
            t.borderBottomWidth = "0px",
            b -= n.offsetHeight,
            t.borderLeftWidth = l + "px",
            t.borderTopWidth = o + "px",
            t.borderRightWidth = r + "px",
            t.borderBottomWidth = b + "px";
            var s = {
                l: l,
                r: r,
                t: o,
                b: b,
                x: l,
                y: o
            };
            return s
        }
        var s = {
            x: this.parseInt(n.style.borderLeftWidth),
            y: this.parseInt(n.style.borderTopWidth),
            r: this.parseInt(n.style.borderRightWidth),
            b: this.parseInt(n.style.borderBottomWidth)
        };
        return s.l = s.x,
        s.t = s.y,
        s
    },
    getSize: function(n, withMargin) {
        var c = {
            x: null != n.offsetWidth ? n.offsetWidth: 0,
            y: null != n.offsetHeight ? n.offsetHeight: 0
        };
        if (withMargin) {
            var m = this.getMargin(n);
            c.x += m.l + m.r,
            c.y += m.t + m.b
        }
        return c
    },
    setSize: function(elmt, x, y, withMargin) {
        if ($IE) {
            if (withMargin) {
                var m = this.getMargin(elmt);
                x -= m.l + m.r,
                y -= m.t + m.b
            }
            elmt.style.width = x,
            elmt.style.height = y
        } else {
            var clientSize = this.getClientSize(elmt),
            dx = clientSize.l + clientSize.r,
            dy = clientSize.t + clientSize.b;
            elmt.style.width = x - dx + "px",
            elmt.style.height = y - dy + "px"
        }
    },
    getPosition: function(elmt, withMargin) {
        var c;
        if (c = {
            x: elmt.offsetLeft,
            y: elmt.offsetTop
        },
        withMargin) {
            var m = this.getMargin(elmt);
            c.x -= m.l,
            c.y -= m.t
        }
        return c
    },
    setPosition: function(elmt, x, y, withMargin) {
        elmt.style.left = x + "px",
        elmt.style.top = y + "px"
    },
    setAlpha: function(n, a) {}
},
$motion = {
    smooth: function(s, e, t) {
        return t > 1 && (t = 1),
        (e - s) * t + s
    }
};
PopUp.STOP = 0,
PopUp.MOVE_DOWN = 1,
PopUp.MOVE_UP = 2,
PopUp.SWITCH_TO_MIN = 4 | PopUp.MOVE_DOWN,
PopUp.SWITCH_TO_MAX = 8 | PopUp.MOVE_UP;
var __o = {
    create: function() {
        var doc = document,
        c = this.config,
        p = this.popup = doc.createElement("div");
        this.container.appendChild(p),
        p.id = this.id,
        p.style.cssText = "position:absolute;       z-index:9000;       overflow:hidden;       border:0px solid #f00;       ",
        $dom.setSize(p, c.width, c.height);
        var t = this.content = doc.createElement("div");
        p.appendChild(t),
        t.id = this.id + "_content",
        t.style.cssText = "position:absolute;       z-index:1;       overflow:hidden;",
        $dom.setSize(t, c.width, c.height),
        $dom.setPosition(t, 0, 0),
        c.position.y = c.height,
        this.onresize();
        t.innerHTML = "<a id='closeButton' href='#'></a><a id='switchButton' href='#'></a>" + '<div class="blogrecommend"><div class="BR_title"></div><div class="BR_conts"></div></div>';
        var sBtn = this.switchButton = $_t(t, "a", "switchButton");
        sBtn.style.cssText = 'position:absolute;        z-index:2;                font-size:0px;        line-height:0px;                left:220px;        top:6px;        width:15px;        height:15px;                background-image:url("' + window_img + 'min.gif");',
        $addEL(sBtn, "click", $dele(this, "switchMode"), !0),
        $addEL(sBtn, "click", $cancelEvent, !0);
        var btn = $_t(t, "a", "closeButton");
        btn.style.cssText = 'position:absolute;        z-index:2;                font-size:0px;        line-height:0px;                left:240px;        top:6px;        width:15px;        height:15px;                background-image:url("' + window_img + 'close.gif");',
        $addEL(btn, "mouseover",
        function(e) {
            $dom.setAlpha(this, .4)
        },
        !0),
        $addEL(btn, "mouseout",
        function(e) {
            $dom.setAlpha(this, 1)
        },
        !0),
        $addEL(btn, "click", $dele(this, "hide"), !0),
        $addEL(btn, "click", $cancelEvent, !0);
        var container = $IE ? document.body: document.documentElement;
        $addEL(document.body, "resize", $dele(this, "onresize"), !0),
        this.__hackTimer = window.setInterval("__popup.onresize()", 50),
        $addEL(container, "scroll", $dele(this, "onresize"), !0),
        this.onresize()
    },
    show: function() {
        this.config.display && (this.moveTargetPosition = 0, this.status = PopUp.MOVE_UP, this.startMove())
    },
    hide: function() {
        this.moveTargetPosition = this.config.height,
        this.status = PopUp.MOVE_DOWN,
        this.startMove()
    },
    minimize: function() {
        this.mm = "min",
        this.moveTargetPosition = this.config.height - 28,
        this.status = PopUp.SWITCH_TO_MIN,
        this.startMove();
        var s = this.switchButton.style,
        bg = s.backgroundImage;
        bg.indexOf(this.imgMin) > -1 && (bg = bg.replace(this.imgMin, this.imgMax), s.backgroundImage = bg)
    },
    maximize: function() {
        if (this.config.display) {
            this.mm = "max",
            this.moveTargetPosition = 0,
            this.status = PopUp.SWITCH_TO_MAX,
            this.startMove();
            var s = this.switchButton.style,
            bg = s.backgroundImage;
            bg.indexOf(this.imgMax) > -1 && (bg = bg.replace(this.imgMax, this.imgMin), s.backgroundImage = bg)
        }
    },
    delayHide: function() {
        window.setTimeout("__popup.hide()", this.config.time.hold)
    },
    delayMin: function() {
        window.setTimeout("__popup.minimize()", this.config.time.hold)
    },
    switchMode: function() {
        "min" == this.mm ? this.maximize() : this.minimize()
    },
    startMove: function() {
        this.stopMove(),
        this.intervalHandle = window.setInterval("__popup.move()", 100),
        this.startMoveTime = (new Date).getTime(),
        this.startPosition = this.config.position.y
    },
    stopMove: function() {
        null != this.intervalHandle && window.clearInterval(this.intervalHandle),
        this.intervalHandle = null
    },
    move: function() {
        var t = (new Date).getTime();
        t -= this.startMoveTime;
        var total = this.status & PopUp.MOVE_UP ? this.config.time.slideIn: this.config.time.slideOut,
        y = this.config.motionFunc(this.startPosition, this.moveTargetPosition, t / total);
        this.config.position.y = y,
        this.onresize(),
        t >= total && this.onFinishMove()
    },
    onFinishMove: function() {
        this.stopMove(),
        this.status == PopUp.MOVE_UP && this.config.time.hold > 0 ? this.delayMin() : null != this.__hackTimer && window.clearInterval(this.__hackTimer),
        this.status = PopUp.STOP
    },
    onresize: function() {
        var c = this.config,
        t = document.body,
        dx = t.clientWidth + t.scrollLeft,
        dy = t.clientHeight + t.scrollTop,
        x = dx - c.right - c.width,
        y = dy - c.bottom - c.height + c.position.y;
        $dom.setPosition(this.popup, x, y),
        $dom.setSize(this.popup, c.width, c.height - c.position.y)
    }
};
$cpAttr(PopUp.prototype, __o);