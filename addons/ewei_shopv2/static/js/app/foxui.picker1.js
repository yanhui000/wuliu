var FoxUIPicker = function (params) {

    var defaults = {
        title: '',
        showCancelButton: true,
        updateValueOnTouch: false,
        inputReadOnly: true,
        valueDivider: ' '
    };
    var self = this;
    self.params = $.extend({}, defaults, params || {});

    self.initValue = function (value) {
        if (typeof (value) === 'string') {
            return value.split(self.params.valueDivider);
        }
        return value;
    };

    if (self.params.value) {
        self.params.value = self.initValue(self.params.value);

    }
    if (self.params.initValue) {
        self.params.initValue = self.initValue(self.params.initValue);
    }
    if (self.value) {
        self.value = self.initValue(self.value);
    }

    if (self.params.valueDivider === '') {
        self.params.valueDivider = ' ';
    }

    self.oldValue = [];
    self.inited = false;
    self.setValue = function (values, transition) {
        var valueIndex = 0;
        var len = self.columns.length;

        for (var i = 0; i < len; i++) {
            if (!self.columns[i].divider) {

                self.columns[i].setValue(values[valueIndex], transition);
                valueIndex++;
            }
        }
    };


    self.updateValue = function (colIndex) {
        var newValue = [];
        var newDisplayValue = [];

        $.each(self.columns, function () {
            if (!this.divider) {
                newValue.push(this.value);
                newDisplayValue.push(this.displayValue);
            }
        });
        if (newValue.indexOf(undefined) >= 0) {
            return;
        }

        self.value = newValue;
        self.displayValue = newDisplayValue;

        if (self.params.onChange) {


            self.params.onChange(self, colIndex);
        }
        if (self.params.updateValueOnTouch) {
            if (self.input && self.input.length > 0) {

                var value = self.getValue();
                if (self.params.formatValue) {
                    value = self.params.formatValue(value);
                } else {
                    value = value.join(self.params.valueDivider);
                }
                self.input.val(value);
                self.input.trigger('change');
            }
        }

    };
    self.getValue = function () {
        var values = [];
        $.each(self.columns, function () {
            if (!this.divider) {
                if (this.value !== undefined && this.values && this.values.length > 0) {
                    values.push(this.value);
                }

            }

        });
        return values;
    };
    self.getTexts = function () {
        var values = [];
        $.each(self.columns, function () {
            if (!this.divider) {
                if (this.displayValue) {
                    values.push(this.displayValue);
                }

            }

        });
        return values;
    };


    self.getValueIndex = function (colIndex) {


        var len = self.columns.length;
        var valueIndex = 0;
        for (var i = 0; i < len; i++) {
            if (!self.columns[i].divider) {
                if (colIndex == i) {
                    break;
                }
                valueIndex++;
            }
        }
        return valueIndex;

    };


    self.getColumnHTML = function (column, onlyItems) {
        var columnItemsHTML = '';
        var columnHTML = '';
        if (column.divider) {
            columnHTML += '<div class="fui-picker-col fui-picker-col-divider ' + (column.align ? 'fui-picker-col-' + column.align : '') + ' ' + (column.css || '') + '">' + (column.content || '') + '</div>';
        } else {

            for (var i = 0; i < column.values.length; i++) {
                var columnValue = column.values[i], text;
                if (typeof (columnValue) == 'object') {
                    value = columnValue.value ? columnValue.value : columnValue.text;
                    text = columnValue.text;
                } else {
                    value = text = columnValue;
                }
                columnItemsHTML += '<div class="fui-picker-item" data-value="' + value + '">' + text + '</div>';
            }
            columnHTML += '<div class="fui-picker-col ' + (column.align ? 'fui-picker-col-' + column.align : '') + ' ' + (column.css || '') + '"><div class="fui-picker-wrapper">' + columnItemsHTML + '</div></div>';
        }
        return onlyItems ? columnItemsHTML : columnHTML;
    };

    self.initColumn = function (colObj, updateItems) {
        var colElement = $(colObj);
        var colIndex = colElement.index();
        var col = self.columns[colIndex];
        if (col.divider) {
            return;
        }

        col.container = colElement;
        col.wrapper = colElement.find('.fui-picker-wrapper');
        col.items = col.wrapper.find('.fui-picker-item');


        var wrapperHeight, itemHeight, itemsHeight, minTranslate, maxTranslate;
        col.resize = function () {
            if (col.items.length <= 0) {
                return;
            }

            var width = 0,
                height = col.container[0].offsetHeight;
            wrapperHeight = col.wrapper[0].offsetHeight;

            itemHeight = col.items[0].offsetHeight;
            itemsHeight = itemHeight * col.items.length;
            minTranslate = height / 2 - itemsHeight + itemHeight / 2;
            maxTranslate = height / 2 - itemHeight / 2;
        };
        col.resize();
        col.wrapper.transform('translate3d(0,' + maxTranslate + 'px,0)').transition(0);
        var activeIndex = 0;
        col.setValue = function (value, transition, updateValue) {

            transition = transition || '';
            if (typeof (value) == 'object') {
                value = value.value ? value.value : value.text;
            }
            var newItem = col.wrapper.find('.fui-picker-item[data-value="' + value + '"]');
            var newActiveIndex = -1;
            if (newItem.length > 0) {
                newActiveIndex = newItem.index();
            }

            if (newActiveIndex == -1) {
                return;
            }

            var newTranslate = -newActiveIndex * itemHeight + maxTranslate;
            col.wrapper.transition(transition);
            col.wrapper.transform('translate3d(0,' + (newTranslate) + 'px,0)');

            col.updateItems(newActiveIndex, newTranslate, transition, updateValue);

        };

        col.updateItems = function (activeIndex, translate, transition, updateValue) {
            translate = translate || $.getTranslate(col.wrapper[0], 'y');
            activeIndex = activeIndex || -Math.round((translate - maxTranslate) / itemHeight);


            if (activeIndex < 0) {
                activeIndex = 0;
            }
            if (activeIndex >= col.items.length) {
                activeIndex = col.items.length - 1;
            }

            var oldActiveIndex = col.activeIndex;
            col.activeIndex = activeIndex;
            col.wrapper.find('.selected').removeClass('selected');


            if (updateValue || updateValue === undefined) {

                var selectedItem = col.items.eq(activeIndex).addClass('selected').transform('');
                col.value = selectedItem.data('value');
                //col.displayValue = col.displayValues ? col.displayValues[activeIndex] : col.value;
                col.displayValue = selectedItem.text();


                if (oldActiveIndex != activeIndex) {


                    if (col.onChange) {
                        col.onChange(self, col);
                    }
                    self.updateValue(colIndex);
                }
            }

        };

        if (updateItems) {
            col.updateItems(0, maxTranslate, 0);
        }

        var allowItemClick = true;
        var isTouched, isMoved;
        var touchStartY, touchCurrentY;
        var touchStartTime, touchEndTime;
        var startTranslate, returnTo, currentTranslate, prevTranslate, velocityTranslate, velocityTime;

        function onColTouchStart(e) {

            if (isMoved || isTouched) {
                return;
            }

            isTouched = true;
            touchStartY = touchCurrentY = e.type === 'touchstart' ? e.originalEvent.targetTouches[0].pageY : e.pageY;
            touchStartTime = (new Date()).getTime();

            allowItemClick = true;
            startTranslate = currentTranslate = $.getTranslate(col.wrapper[0], 'y');

        }

        function onColTouchMove(e) {

            if (!isTouched) {
                return;
            }
            e.preventDefault();
            allowItemClick = false;
            touchCurrentY = e.type === 'touchmove' ? e.originalEvent.targetTouches[0].pageY : e.pageY;
            if (!isMoved) {

                isMoved = true;
                startTranslate = currentTranslate = $.getTranslate(col.wrapper[0], 'y');
                col.wrapper.transition(0);
            }
            e.preventDefault();

            var diff = touchCurrentY - touchStartY;
            currentTranslate = startTranslate + diff;
            returnTo = undefined;

            if (currentTranslate < minTranslate) {
                currentTranslate = minTranslate - Math.pow(minTranslate - currentTranslate, 0.8);
                returnTo = 'min';
            }
            if (currentTranslate > maxTranslate) {
                currentTranslate = maxTranslate + Math.pow(currentTranslate - maxTranslate, 0.8);
                returnTo = 'max';
            }

            col.wrapper.transform('translate3d(0,' + currentTranslate + 'px,0)');
            col.updateItems(undefined, currentTranslate, 0);

            velocityTranslate = currentTranslate - prevTranslate || currentTranslate;
            velocityTime = (new Date()).getTime();
            prevTranslate = currentTranslate;
        }

        function onColTouchEnd(e) {

            if (!isTouched || !isMoved) {

                isTouched = isMoved = false;
                return;
            }

            isTouched = isMoved = false;
            col.wrapper.transition('');
            if (returnTo) {
                if (returnTo === 'min') {
                    col.wrapper.transform('translate3d(0,' + minTranslate + 'px,0)');
                } else {
                    col.wrapper.transform('translate3d(0,' + maxTranslate + 'px,0)');
                }
            }
            touchEndTime = new Date().getTime();

            var velocity, newTranslate;
            if (touchEndTime - touchStartTime > 300) {
                newTranslate = currentTranslate;
            } else {
                allowItemClick = true;
                velocity = Math.abs(velocityTranslate / (touchEndTime - velocityTime));
                newTranslate = currentTranslate + velocityTranslate * 10;

            }

            newTranslate = Math.max(Math.min(newTranslate, maxTranslate), minTranslate);

            var activeIndex = -Math.floor((newTranslate - maxTranslate) / itemHeight);
            newTranslate = -activeIndex * itemHeight + maxTranslate;
            col.wrapper.transform('translate3d(0,' + (parseInt(newTranslate, 10)) + 'px,0)');
            col.updateItems(activeIndex, newTranslate, '', true);


            setTimeout(function () {
                allowItemClick = true;
            }, 100);


        }

        function onColClick(e) {

            if (!allowItemClick) {
                return;
            }
            var value = $(this).data('value');

            col.setValue(value);

        }

        col.initEvents = function (detach) {
            var method = detach ? 'off' : 'on';
            col.container[method]($.touchEvents.start, onColTouchStart);
            col.container[method]($.touchEvents.move, onColTouchMove);
            col.container[method]($.touchEvents.end, onColTouchEnd);
            col.items[method]('click', onColClick);
        };

        col.container[0].destory = function () {

            col.initEvents(true);
        };

        col.replaceValues = function (values) {

            col.initEvents(true);

            col.values = values;
            var newItemsHTML = self.getColumnHTML(col, true);

            col.wrapper.html(newItemsHTML);
            col.items = col.wrapper.find('.fui-picker-item');
            col.resize();

            col.setValue(values[0], 0, true);
            col.initEvents();

            if (self.params.onReplaceValues) {
                self.params.onReplaceValues(self, colIndex);
            }
        };

        col.initEvents();

    };
    self.setInputValue = function (value) {
        if (self.input && self.input.length > 0) {

            value = value || self.getValue();
            if (self.params.formatValue) {
                value = self.params.formatValue(value);

            } else {
                value = value.join(self.params.valueDivider);
            }

            var texts = self.getTexts();
            if(self.params.new_area || self.params.street){
                $(self.input).val(texts.join(self.params.valueDivider)).attr('data-value', value );
            }else{
                $(self.input).val(value);
            }

        }

    };
    self.isshow = false;
    self.show = function () {

        if (self.isshow) {
            return;
        }
        self.columns = [];

        var titleHTML = '';
        var cancelButtonHTML = "<a href='javascript:' class='text-cancel fui-picker-cancel'>取消</a>";
        titleHTML += "<div class='fui-picker-header'>" +
        "<div class='left '>" + (self.params.showCancelButton ? cancelButtonHTML : '') + "</div>" +
        "<div class='center'>" + (self.params.title || "") + "</div>" +
        "<div class='right'><a href='javascript:' class='text-success fui-picker-confirm'>确定</a></div>" +
        "</div>";

        var columnsHTML = '';
        $.each(self.params.columns, function () {
            columnsHTML += self.getColumnHTML(this);
            self.columns.push(this);
        });

        self.pickerHTML =
            '<div class="fui-picker ' + (self.params.css || '') + '">' +
            titleHTML +
            '<div class="fui-picker-content">' +
            columnsHTML +
            '<div class="fui-picker-highlight"></div>' +
            '</div>' +
            '</div>';

        self.container = new FoxUIModal({
            content: self.pickerHTML,
            extraClass:'picker-modal',
            mask:false
        });

        self.container.show();


        self.isshow = true;
        self.container.container.find('.fui-picker-col').each(function () {
            var updateItems = true;
            if ((!self.inited && self.params.value) || (self.inited && self.value)) {
                updateItems = false;
            }
            self.initColumn(this, updateItems);
        });
        self.container.container.find('.fui-picker-confirm').on('click', function () {
            if (!self.params.updateValueOnTouch) {
                self.setInputValue();
            }
            self.close();
        });

        if (self.params.showCancelButton) {
            self.container.container.find('.fui-picker-cancel').on('click', function () {
                if (self.oldValue !== '') {

                    self.setInputValue(self.oldValue);
                }
                self.close();
            });
        }

        if (!self.inited) {
            if (self.params.value) {

                self.setValue(self.params.value, 0);
            } else if (self.params.initValue) {
                self.setValue(self.params.initValue, 0);
            }

        } else {

            if (self.value) {

                self.setValue(self.value, 0);
            } else if (self.initValue) {
                self.setValue(self.initValue, 0);
            }
        }
        self.inited = true;
        if (self.params.onShow) {
            self.params.onShow(self);
        }
    };

    if (self.params.input) {

        self.input = $(self.params.input);
        if (self.input.length > 0) {

            self.oldValue = self.input.val();

            if (self.params.inputReadOnly) {
                self.input.attr('readonly', true);
            }
            self.input.on('click', function (e) {
                e.preventDefault();
                // 安卓微信软键盘问题
                if ($.device.isWeixin && $.device.android && self.params.inputReadOnly) {
                    this.focus();
                    this.blur();
                }
                if (!self.isshow) {
                    self.show();
                }
            });
        }
    }


    self.close = function () {
        if (!self.isshow) {
            return;
        }
        self.container.container.find('.fui-picker-col').each(function () {
            if (this.destroy) {
                this.destroy();
            }
        });
        self.container.close();

        self.isshow = false;
        if (self.params.onClose) {
            self.params.onClose(self);
        }


    };
    self.destroy = function () {

        self.close();
        if (self.input && self.input.length > 0) {
            self.input.off('click');
        }
        $('html').off('click');
        $(window).off('resize');
    };

    $('html').on('click', function (e) {
        if (!self.isshow) {
            return;
        }
        if (self.input && self.input.length > 0) {
            if (e.target === self.input[0]) {
                return;
            }
        }
        if ($(e.target).parents('.fui-picker').length > 0) {
            return;
        }
        self.close();
    });


    function resizeColumns() {
        if (!self.isshow) {
            return;
        }
        $.each(self.columns, function () {
            if (!this.divider) {
                this.resize();

                this.setValue(this.value, 0);
            }
        });
        if (self.params.onResize) {
            self.params.onResize(self);
        }
    }
    $(window).on('resize', resizeColumns);

};
$.fn.picker = function (params) {
    var args = arguments;
    return this.each(function () {
        if (!this)
            return;
        var $this = $(this);
        var picker = $this.data("picker");
        if (!picker) {
            params = $.extend({
                input: this,
                value: $this.val() ? $this.val() : ''
            }, params);
            picker = new FoxUIPicker(params);
            $this.data("picker", picker);
        }
        if (typeof params === typeof "a") {
            picker[params].apply(picker, Array.prototype.slice.call(args, 1));
        }
    });
};
var FoxUIDateTimePicker = function (showDate, showTime) {
    var self = this;
    self.showDate = showDate === undefined ? true : showDate;
    self.showTime = showTime === undefined ? true : showTime;
    self.today = new Date();
    self.getDays = function (max) {
        var days = [];
        for (var i = 1; i <= (max || 31); i++) {
            days.push(this.format(i));
        }
        return days;
    };
    self.getDaysByYearAndMonth = function (year, month) {
        var day = new Date(year, parseInt(month) + 1 - 1, 1);
        var max = new Date(day - 1).getDate();
        return self.getDays(max);
    };

    self.format = function (num) {
        return num < 10 ? "0" + num : num;
    };

    self.getTodayValue = function () {

        var values = [];
        if (self.showDate) {
            values.push(self.today.getFullYear());
            values.push(self.format(self.today.getMonth() + 1));
            values.push(self.format(self.today.getDate()));
        }
        if (self.showTime) {
            values.push(self.format(self.today.getHours()));
            values.push(self.format(self.today.getMinutes()));
        }
        return values;
    };

    self.params = {
        initValue: self.getTodayValue(),

        onChange: function (picker, colIndex) {

            if (!self.showDate) {
                return;
            }
            var daysValue = picker.columns[4].value;
            var days = self.getDaysByYearAndMonth(picker.columns[0].value, picker.columns[2].value);
            if (colIndex == 0 || colIndex == 2) {
                picker.columns[4].replaceValues(days);
            }
            if (daysValue > days.length) {
                daysValue = days.length;
            }
            picker.columns[4].setValue(daysValue);
        },
        onShow: function (picker) {

            //设置默认值
            if (picker.input && picker.input.length > 0) {
                var val = picker.input.val();
                if (val) {
                    var values = val.split(picker.params.valueDivider);
                    var dates = values[0].split('-');
                    picker.columns[0].setValue(dates[0]);
                    picker.columns[2].setValue(dates[1]);

                    if(picker.columns[4]) {
                        picker.columns[4].setValue(dates[2]);
                    }

                    if(values[0]) {
                        var times = values[0].split(':');
                        if(times[1]) {
                            picker.columns[0].setValue(times[0]);
                            picker.columns[2].setValue(times[1]);
                        }
                    }

                    if(values[1]) {
                        var times = values[1].split(':');
                        picker.columns[6].setValue(times[0]);
                        picker.columns[8].setValue(times[1]);
                        picker.columns[10].setValue(times[2]);
                    }
                }
            }
        },
        formatValue: function (value) {
            var ret = '';

            if (self.showDate && self.showTime) {
                ret += value[0] + '-' + value[1] + '-' + value[2] + ' ' + value[3] + ':' + value[4];
            } else if (self.showDate) {
                ret += value[0] + '-' + value[1] + '-' + value[2];
            } else if (self.showTime) {
                ret += value[0] + ':' + value[1];
            }

            return ret;
        },
        columns: []
    };

    if (self.showDate) {
        self.params.columns.push({
            values: (function () {
                var years = [];
                for (var i = 1950; i <= 2030; i++) {
                    years.push(i);
                }
                return years;
            })()
        });
        self.params.columns.push({
            divider: true,
            content: '-'
        });
        self.params.columns.push({
            values: (function () {
                var months = [];
                for (var i = 1; i <= 12; i++) {
                    months.push(self.format(i));
                }
                return months;
            })()
        });
        self.params.columns.push({
            divider: true,
            content: '-'
        });
        self.params.columns.push({
            values: self.getDays()
        });
        if (self.showTime) {
            self.params.columns.push({
                divider: true,
                content: ' '
            });
        }
    }
    if (self.showTime) {
        self.params.columns.push({
            values: (function () {
                var hours = [];
                for (var i = 0; i <= 23; i++) {
                    hours.push(self.format(i));
                }
                return hours;
            })()
        });
        self.params.columns.push({
            divider: true,
            content: ':'
        });

        self.params.columns.push({
            values: (function () {
                var minutes = [];
                for (var i = 0; i <= 59; i++) {
                    minutes.push(i < 10 ? '0' + i : i);
                }
                return minutes;
            })()
        });
    }
};

$.fn.datetimePicker = function (params) {
    var args = arguments;
    return this.each(function () {
        if (!this)
            return;
        var $this = $(this);
        var datetimePicker = $this.data("datetimePicker");
        if (!datetimePicker) {
            datetimePicker = new FoxUIDateTimePicker(true, true);
            $this.data("datetimePicker", datetimePicker);
        }
        var p = $.extend(datetimePicker.params, params || {});
        $(this).picker(p);

        if (p.value) {
            $(this).val(p.formatValue(p.value));
        }
        if (typeof params === typeof "a") {
            datetimePicker[params].apply(datetimePicker, Array.prototype.slice.call(args, 1));
        }
    });
};
$.fn.datePicker = function (params) {
    var args = arguments;
    return this.each(function () {
        if (!this)
            return;
        var $this = $(this);
        var datePicker = $this.data("datePicker");
        if (!datePicker) {
            datePicker = new FoxUIDateTimePicker(true, false);
            $this.data("datePicker", datePicker);
        }
        var p = $.extend(datePicker.params, params || {});
        $(this).picker(p);

        if (p.value) {
            $(this).val(p.formatValue(p.value));
        }
        if (typeof params === typeof "a") {
            datePicker[params].apply(datePicker, Array.prototype.slice.call(args, 1));
        }
    });
};
$.fn.timePicker = function (params) {
    var args = arguments;
    return this.each(function () {
        if (!this)
            return;
        var $this = $(this);
        var timePicker = $this.data("timePicker");
        if (!timePicker) {
            timePicker = new FoxUIDateTimePicker(false, true);
            $this.data("timePicker", timePicker);
        }
        var p = $.extend(timePicker.params, params || {});
        $(this).picker(p);

        if (p.value) {
            $(this).val(p.formatValue(p.value));
        }
        if (typeof params === typeof "a") {
            timePicker[params].apply(timePicker, Array.prototype.slice.call(args, 1));
        }
    });
};




var FoxUIRelatePicker = function (params) {
    var self = this;
    self.allValues = [];
    self.setAllValues = function (obj, lastTag) {
        $.each(obj.children, function () {
            var value = this.value ? this.value : this.text;
            if (value === undefined) {
                return false;
            }
            var tag = lastTag + value;
            self.allValues.push({
                tag: tag,
                children: this.children
            });
            self.setAllValues(this, tag);
        });

    };
    self.getChildren = function (value) {
        var children = [];
        $.each(self.allValues, function () {

            if (this.tag == value) {

                children = this.children;
                return false;
            }
        });
        return children;
    };
    self.getNextColIndex = function (picker, colIndex) {
        var nextColIndex = -1;
        $.each(picker.columns, function (i) {
            if (i > colIndex && !this.divider) {
                nextColIndex = i;
                return false;
            }
        });
        return nextColIndex;
    };
    self.getColIndex = function (findValueIndex) {
        var len = self.params.columns.length;
        var valueIndex = 0;
        var locals = [];
        var ret = -1;
        for (var i = 0; i < len; i++) {

            if (!self.params.columns[i].divider) {

                if (valueIndex == findValueIndex) {
                    ret = i;
                    break;
                }
                valueIndex++;
            }
        }
        return ret;
    };
    self.params = {
        onChange: function (picker, colIndex) {

            if (colIndex >= picker.columns.length - 1) {
                return;
            }

            var selectedValue = [];
            for (var i = 0; i <= colIndex; i++) {
                if (!picker.columns[i].divider) {
                    selectedValue.push(picker.columns[i].value);
                }
            }
            selectedValue = selectedValue.join('');

            if (!selectedValue) {
                return;
            }


            var nextColIndex = self.getNextColIndex(picker, colIndex);
            if (nextColIndex != -1) {
                var children = self.getChildren(selectedValue);
                if (children) {
                    picker.columns[nextColIndex].replaceValues(children);
                }
                self.params.onChange(picker, nextColIndex);
            }
        },
        onShow: function (picker) {

            //设置默认值
            if (picker.input && picker.input.length > 0) {

                var val = picker.input.attr('data-value') || picker.input.val();

                if (val) {
                    var values = val.split(self.params.valueDivider);

                    $.each(picker.columns, function (i) {
                        if (!this.divider) {
                            var valueIndex = picker.getValueIndex(i);
                            this.setValue(values[valueIndex], 0);
                        }
                    });
                }
            }
        }
    };
    self.firstValues = [];
    self.setFirstValue = function (obj) {

        var val = obj;
        if (typeof (obj) == 'object') {
            val = obj.value ? obj.value : obj.text;
        }

        self.firstValues.push(val);

        if (typeof (obj) == 'object' && obj.children) {
            self.setFirstValue(obj.children[0]);
        }
    };
    self.init = function (_params, inputValue) {

        self.params = $.extend(self.params, _params || {});

        //初始化所有数据的子数据
        if (!self.allValues || self.allValues.length <= 0) {
            $.each(self.params.columns[0].values, function (i) {
                self.allValues.push({
                    tag: this.value ? this.value : this.text,
                    children: this.children
                });

                var tag = this.value ? this.value : this.text;
                self.setAllValues(this, tag, i);
            });
        }

        //初始化第一条默认记录
        if (!self.firstValues || self.firstValues.length <= 0) {
            self.setFirstValue(self.params.columns[0].values[0]);
        }

        //初始化每一列的数据
        self.params.valueDivider = self.params.valueDivider || ' ';

        if (inputValue) {
            self.params.value = $.trim( inputValue ).split(self.params.valueDivider);
        }

        if (self.params.value === undefined) {
            self.params.value = self.firstValues;
        }

        var maxValueIndex = 0;
        $.each(self.params.columns, function (i) {
            if (!this.divider) {
                maxValueIndex++;
            }
        });

        for (var i = 1; i <= maxValueIndex - 1; i++) {
            var a = self.params.value.slice(0, i).join('');
            var colIndex = self.getColIndex(i);
            self.params.columns[colIndex].values = self.getChildren(a);
        }
    };
};
$.fn.relatePicker = function (params) {
    var args = arguments;
    return this.each(function () {
        if (!this)
            return;
        var $this = $(this);
        var relatePicker = $this.data("relatePicker");
        if (!relatePicker) {
            relatePicker = new FoxUIRelatePicker(params);
            $this.data("relatePicker", relatePicker);
        }
        relatePicker.init(params,  $this.attr('data-value') || $this.val() );
        $(this).picker(relatePicker.params);

        if (typeof params === typeof "a") {
            relatePicker[params].apply(relatePicker, Array.prototype.slice.call(args, 1));
        }
    });
};


$.fn.cityPicker = function (params) {
    var args = arguments;
    return this.each(function () {
        if (!this)
            return;
        var $this = $(this);
        var p = $.extend({},params || {});
        var cityPicker = $this.data("cityPicker");
        if (!cityPicker) {
            cityPicker = new FoxUIRelatePicker(p);
            $this.data("cityPicker", cityPicker);
        }

        if(params.street){
            var realData = params.data;
        } else if(params.new_area){
            var realData = FoxUICityDataNew;
        } else {
          
            var realData = [{
    "text": "今天",
    "children": [{
        "text": "全天",
        "children": ["都可以"]
    }, {
        "text": "上午",
        "children": ["都可以", "12:00"]
    },
    {
        "text": "下午",
        "children": ["都可以", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00"]
    },
    {
        "text": "晚上",
        "children": ["都可以", "19:00", "20:00", "21:00", "22:00", "23:00", "24:00"]
    }
    ]
},
{
    "text": "明天",
    "children": [{
        "text": "全天",
        "children": ["都可以"]
    }, {
        "text": "上午",
        "children": ["都可以", "12:00"]
    },
    {
        "text": "下午",
        "children": ["都可以", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00"]
    },
    {
        "text": "晚上",
        "children": ["都可以", "19:00", "20:00", "21:00", "22:00", "23:00", "24:00"]
    }
    ]
},
{
    "text": "后天",
    "children": [{
        "text": "全天",
        "children": ["都可以"]
    }, {
        "text": "上午",
        "children": ["都可以", "12:00"]
    },
    {
        "text": "下午",
        "children": ["都可以", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00"]
    },
    {
        "text": "晚上",
        "children": ["都可以", "19:00", "20:00", "21:00", "22:00", "23:00", "24:00"]
    }
    ]
}
];
        }

        if(params.street){
            showArea = false;
            showCity = false;
            cityPicker.params =$.extend(p, {
                columns: [{align: 'center', values: realData,'css':''}]
            });
        } else {
            cityPicker.params =$.extend(p, {
                columns: [{align: 'center', values: realData,'css':'col-province'}]
            });
            var showCity = p.showCity === undefined ? true : params.showCity;
            var showArea = p.showArea === undefined ? true : params.showArea;
        }

        if (showCity) {
            cityPicker.params.columns.push({align: 'center','css':'col-city'});
            if (showArea) {
                cityPicker.params.columns.push({align: 'center','css':'col-area'});
            }
        }

        cityPicker.init(cityPicker.params, $(this).attr('data-value') || $(this).val());
        $(this).relatePicker(cityPicker.params);

        if (typeof params === typeof "a") {
            cityPicker[params].apply(cityPicker, Array.prototype.slice.call(args, 1));
        }
    });
};