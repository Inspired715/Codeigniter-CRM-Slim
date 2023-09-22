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

import UserFieldView from 'views/fields/user';

class UserWithAvatarFieldView extends UserFieldView {

    listTemplate = 'fields/user-with-avatar/list'
    detailTemplate = 'fields/user-with-avatar/detail'

    data() {
        let o = super.data();

        if (this.mode === this.MODE_DETAIL) {
            o.avatar = this.getAvatarHtml();
            o.isOwn = this.model.get(this.idName) === this.getUser().id;
        }

        return o;
    }

    getAvatarHtml() {
        return this.getHelper().getAvatarHtml(this.model.get(this.idName), 'small', 14, 'avatar-link');
    }
}

export default UserWithAvatarFieldView;
