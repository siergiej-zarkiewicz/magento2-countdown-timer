/**
 * Zarkiewicz\CountdownTimer.
 *
 * @package Zarkiewicz\CountdownTimer
 * @author Siergiej Zarkiewicz <siergiej.zarkiewicz@gmail.com>
 * @copyright Siergiej Zarkiewicz <ssiergiej.zarkiewicz@gmail.com>
 * @license Open Software License (OSL 3.0)
 */
define([
    'underscore',
    'uiElement'
], function (_, Element) {
    'use strict';

    return Element.extend({
        defaults: {
            template: 'Zarkiewicz_CountdownTimer/product/view/timer'
        },

        getTimerData: function () {
            return _.map(this.data, function (item) {
                return {
                    'label': item.label,
                    'value': item.value
                };
            });
        }
    });
});
