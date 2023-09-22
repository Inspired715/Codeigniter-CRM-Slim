/************************************************************************
 * This file is part of EspoCRM.
 *
 * EspoCRM - Open Source CRM application.
 * Copyright (C) 2014-2023 Yurii Kuznietsov, Taras Machyshyn, Oleksii Avramenko
 * Website: https://www.espocrm.com
 *
 * EspoCRM is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * EspoCRM is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with EspoCRM. If not, see http://www.gnu.org/licenses/.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "EspoCRM" word.
 ************************************************************************/

/** @module views/fields/datetime-short */

import DatetimeFieldView from 'views/fields/datetime';
import moment from 'moment';

class DatetimeShortFieldView extends DatetimeFieldView {

    listTemplate = 'fields/datetime-short/list'
    detailTemplate = 'fields/datetime-short/detail'

    data() {
        let data = super.data();

        if (this.mode === this.MODE_LIST || this.mode === this.MODE_DETAIL) {
            data.fullDateValue = super.getDateStringValue();
        }

        return data;
    }

    getDateStringValue() {
        if (!(this.mode === this.MODE_LIST || this.mode === this.MODE_DETAIL)) {
            return super.getDateStringValue();
        }

        let value = this.model.get(this.name)

        if (!value) {
            return super.getDateStringValue();
        }

        let timeFormat = this.getDateTime().timeFormat;

        if (this.params.hasSeconds) {
            timeFormat = timeFormat.replace(/:mm/, ':mm:ss');
        }

        let m = this.getDateTime().toMoment(value);
        let now = moment().tz(this.getDateTime().timeZone || 'UTC');

        if (
            m.unix() > now.clone().startOf('day').unix() &&
            m.unix() < now.clone().add(1, 'days').startOf('day').unix()
        ) {
            return m.format(timeFormat);
        }

        let readableFormat = this.getDateTime().getReadableShortDateFormat();

        return m.format('YYYY') === now.format('YYYY') ?
            m.format(readableFormat) :
            m.format(readableFormat + ', YY');
    }
}

// noinspection JSUnusedGlobalSymbols
export default DatetimeShortFieldView;
