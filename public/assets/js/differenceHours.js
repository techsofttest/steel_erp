var DifferenceHours = function(options){

    /*
     * Variables
     * in the class
     */
    const vars = {
        first_hour_split: null,
        second_hour_split: null,
        $el: null
    };

    /*
     * Can access this.method
     * inside other methods using
     * _this.method()
     */
    let _this = this;

    /*
     * Constructor
     */
    this.construct = function (options) {
        $.extend(vars , options);
    };

    /*
     * PUBLIC
     */

    this.diff_hours = function (time1, time2, result) {
        vars.first_hour_split = time1;
        vars.second_hour_split = time2;
        vars.$el = $(result);

        let hours;
        let minute;

        if (parseInt(vars.first_hour_split[0]) < parseInt(vars.second_hour_split[0]) && parseInt(vars.first_hour_split[1]) < parseInt(vars.second_hour_split[1])) {

            //As for the addition, the subtraction is carried out separately, column by column.
            hours = parseInt(vars.second_hour_split[0]) - parseInt(vars.first_hour_split[0]);
            minute = parseInt(vars.second_hour_split[1]) - parseInt(vars.first_hour_split[1]);

            let _hours = '';
            let _minute = '';

            if (hours < 10) {
                _hours ='0' + hours;
            } else {
                _hours = hours;
            }

            if (minute < 10) {
                _minute = '0' + minute;
            } else {
                _minute = minute;
            }

            vars.$el.text(_hours + '.' + _minute + '')

        }else if (parseInt(vars.second_hour_split[0]) > parseInt(vars.first_hour_split[0])) {
            if (parseInt(vars.second_hour_split[1]) < parseInt(vars.first_hour_split[1])) {

                // As before we subtract column by column ... and we realize that it's impossible because our minute in second hour is greater than our minute in first hour
                // We will transform 1 hour in 60 minutes
                let _hours = parseInt(vars.second_hour_split[0]) - 1;
                let _minute = parseInt(vars.second_hour_split[1]) + 60;
                let final_hours = '';
                let final_min = '';

                hours = _hours - parseInt(vars.first_hour_split[0]);
                minute = _minute - parseInt(vars.first_hour_split[1]);

                if (hours < 10) {
                    final_hours = '0' + hours;
                } else {
                    final_hours = hours;
                }

                if (minute < 10) {
                    final_min = '0' + minute;
                } else {
                    final_min = minute;
                }

                vars.$el.val(final_hours + '.' + final_min)
            }

            if (parseInt(vars.second_hour_split[1]) === parseInt(vars.first_hour_split[1])) {
                hours = parseInt(vars.second_hour_split[0]) - parseInt(vars.first_hour_split[0]);
                let final_hours = '';

                if (hours < 10) {
                    final_hours = '0' + hours;
                } else {
                    final_hours = hours;
                }

                vars.$el.val(final_hours + '.' + '00')
            }

        }else if (parseInt(vars.first_hour_split[0]) > parseInt(vars.second_hour_split[0])) {
            let first_hour_only_hour = parseInt(vars.first_hour_split[0]);
            let second_hour_only_hour = parseInt(vars.second_hour_split[0]);

            let first_hour_only_min = parseInt(vars.first_hour_split[1]);
            let second_hour_only_min = parseInt(vars.second_hour_split[1]);

            let tmp_hour = 24 - first_hour_only_hour;
            let tmp_ttl_hour = tmp_hour + second_hour_only_hour;

            let tmp_ttl_min = first_hour_only_min + second_hour_only_min;
            let tmp_new_hour = 0;
            let tmp_new_min_mod = 0;

            let _hours = '';
            let _min = '';

            if (tmp_ttl_min > 59) {
                tmp_new_hour = parseInt(tmp_ttl_min/60);
                tmp_new_min_mod = tmp_ttl_min%60;

                tmp_ttl_hour += tmp_new_hour;
            } else {
                tmp_new_min_mod = tmp_ttl_min
            }

            if (tmp_ttl_hour < 10) {
                _hours = '0' + tmp_ttl_hour;
            } else {
                _hours = tmp_ttl_hour
            }

            if (tmp_new_min_mod < 10) {
                _min = '0' + tmp_new_min_mod
            } else {
                _min = tmp_new_min_mod
            }

            vars.$el.text(_hours + '.' + _min)
        } else if (parseInt(vars.first_hour_split[0]) === parseInt(vars.second_hour_split[0])) {
            hours = '00';
            let minute = 0;
            if (parseInt(vars.first_hour_split[1]) < parseInt(vars.second_hour_split[1])) {
                minute = parseInt(vars.second_hour_split[1]) - parseInt(vars.first_hour_split[1]);
            }

            if (minute < 10) {
                vars.$el.val(hours + '.0' + minute)
            } else  {
                vars.$el.val(hours + '.' + minute)
            }
        }else if (parseInt(vars.first_hour_split[0]) === 0 && parseInt(vars.first_hour_split[1]) === 0) {
            hours = parseInt(vars.second_hour_split[0]);
            minute = parseInt(vars.second_hour_split[1]);

            if (hours === 0) {
                vars.$el.val('00.' + minute)
            }else if (minute === 0){
                if (hours < 10) {
                    vars.$el.val('0' + hours + '.00');
                }else {
                    vars.$el.val(hours + '.00');
                }
            }else {
                vars.$el.val(hours + '.' + minute)
            }
        }



    };

    /* END PUBLIC FUNCTION */

    this.construct(options);
};


const differenceHours = new DifferenceHours();
