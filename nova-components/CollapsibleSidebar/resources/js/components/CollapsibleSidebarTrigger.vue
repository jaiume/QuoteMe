<template>
    <div class="collapsible-sidebar-trigger" :class="{'is-shy': isShy}">
        <font-awesome-icon :icon="['fas', 'bars']" />
        <font-awesome-icon v-if="!isCollapsed" :icon="['fas', 'chevron-left']" />
        <font-awesome-icon v-if="isCollapsed" :icon="['fas', 'thumbtack']" />
    </div>
</template>

<script>
import { library } from '@fortawesome/fontawesome-svg-core';
import { faThumbtack, faChevronLeft, faBars } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
library.add(faThumbtack, faChevronLeft, faBars);

export default {
    components: {
        'font-awesome-icon': FontAwesomeIcon,
    },

    props: {
        isCollapsed: {
            type: Boolean,
            default: false,
        },
        isShy: {
            type: Boolean,
            default: false,
        },
    },
};
</script>
