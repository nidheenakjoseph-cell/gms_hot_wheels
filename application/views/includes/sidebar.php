<style>

.sidebar nav .has-submenu {
    margin: 4px 0;
}

.sidebar nav .parent-menu-row {
    display: flex;
    align-items: center;
    width: 100%;
    background-color: #f9fafb;
    border-radius: 6px;
    margin: 4px 0;
}

.sidebar nav .parent-menu-row > a {
    flex: 1;

    font-weight: 600;
    font-size: 0.9rem;

    color: #1f2937;

    padding: 10px 16px;

    display: block;

    text-decoration: none;

    border-radius: 6px 0 0 6px;
}

.sidebar nav .parent-menu-row > a:hover {
    background-color: #e5e7eb;
}

.sidebar nav .parent-menu-button {
    flex: 1;

    border: none;

    background-color: transparent;

    text-align: left;

    font-weight: 600;
    font-size: 0.9rem;

    color: #1f2937;

    padding: 10px 16px;

    cursor: pointer;

    border-radius: 6px 0 0 6px;
}

.sidebar nav .parent-menu-button:hover {
    background-color: #e5e7eb;
}

.sidebar nav .has-submenu.menu-open .parent-menu-row > a,
.sidebar nav .has-submenu.menu-open .parent-menu-button {

    background-color: #dbeafe;

    color: #1d4ed8;

    font-weight: 700;
}

.sidebar nav .parent-menu-row > a.active {

    background-color: #dbeafe;

    color: #1d4ed8;

    font-weight: 700;
}

.sidebar nav .submenu-toggle {

    width: 38px;

    min-width: 38px;

    height: 100%;

    border: none;

    background-color: transparent;

    color: #4b5563;

    cursor: pointer;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 0 6px 6px 0;

    padding: 0;
}

.sidebar nav .submenu-toggle:hover {

    background-color: #e5e7eb;

}

.sidebar nav .submenu-toggle span {

    display: inline-block;

    font-size: 12px;

    transition: transform 0.2s ease;

}

.sidebar nav .has-submenu.menu-open
.submenu-toggle span {

    transform: rotate(180deg);

}

.sidebar nav .has-submenu .submenu {

    display: none;

    padding-left: 18px;

    margin-top: 2px;

}

.sidebar nav .has-submenu.menu-open > .submenu {

    display: block;

}

.sidebar nav .submenu a {

    font-size: 0.875rem;

    font-weight: 400;

    color: #4b5563;

    padding: 6px 12px;

    display: block;

    border-radius: 4px;

    text-decoration: none;

    margin: 1px 0;

}

.sidebar nav .submenu a:hover {

    background-color: #f3f4f6;

    color: #111827;

}

.sidebar nav .submenu a.active {

    background-color: #dbeafe;

    color: #1d4ed8;

    font-weight: 700;

    border-left: 3px solid #2563eb;

    padding-left: 9px;

}

.sidebar nav > a {

    display: block;

    text-decoration: none;

    color: #1f2937;

}

.sidebar nav > a.active {

    font-weight: 700;

    background-color: #2563eb;

    color: white;

    padding: 10px 16px;

    border-radius: 6px;

    margin-bottom: 8px;

}

.sidebar nav > a:hover {

    background-color: #e5e7eb;

}

.sidebar nav > a.active:hover {

    background-color: #2563eb;

    color: white;

}

</style>

<aside id="sidebar" class="sidebar flex flex-col">

    <div class="brand flex items-center gap-3 px-4 py-3">
        <?php $company_profile = get_current_company_details(); ?>
        <!-- <img
            src="<?= htmlspecialchars(get_current_company_logo_url('public/images/logoauto1.png', $company_profile), ENT_QUOTES, 'UTF-8') ?>"
            alt="<?= htmlspecialchars($company_profile->company_name ?? 'GMS Logo', ENT_QUOTES, 'UTF-8') ?>"
            class="w-auto"
        > -->
        <img
            src="<?= base_url('public/images/logoauto1.png') ?>"
            alt="GMS Logo"
            class="w-auto"
        >
        <?php if (!empty($company_profile->company_name)): ?>
            <span class="min-w-0 truncate font-semibold" title="<?= htmlspecialchars($company_profile->company_name, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($company_profile->company_name, ENT_QUOTES, 'UTF-8') ?></span>
        <?php endif; ?>

    </div>

    <nav>

        <?php

        $current_route = strtolower(
            trim(
                $this->uri->uri_string(),
                '/'
            )
        );

        ?>

        <a
            href="<?= base_url('index.php/Dashboard'); ?>"
            class="<?=
                (
                    $current_route === '' ||
                    $current_route === 'dashboard'
                )
                ? 'active'
                : ''
            ?>"
        >
            Dashboard
        </a>

        <?php

        $user_id =
            $this->session->userdata('user_id');

        $this->db->select('m.*');

        $this->db->from('menus m');

        $this->db->join(
            'user_menu_access uma',
            'uma.menu_id = m.menu_id'
        );

        $this->db->where(
            'uma.user_id',
            $user_id
        );

        $this->db->where(
            'm.is_active',
            1
        );

        $this->db->where_in(
            'm.display_location',
            ['sidebar', 'both']
        );

        $this->db->order_by(
            'm.sort_order',
            'ASC'
        );

        $menus =
            $this->db
                ->get()
                ->result();

        $menu_tree = [];


        foreach ($menus as $menu) {

            $menu_tree[
                $menu->parent_id
            ][] = $menu;

        }

        if (!function_exists(
            'sidebar_menu_has_active'
        )) {

            function sidebar_menu_has_active(
                $tree,
                $parent_id,
                $current_route
            ) {

                if (
                    !isset(
                        $tree[$parent_id]
                    )
                ) {

                    return false;

                }


                foreach (
                    $tree[$parent_id]
                    as $menu
                ) {

                    $menu_route =
                        strtolower(
                            trim(
                                (string)
                                $menu->menu_url,
                                '/'
                            )
                        );

                    if (
                        $menu_route !== '' &&
                        $current_route ===
                        $menu_route
                    ) {

                        return true;

                    }

                    if (
                        sidebar_menu_has_active(
                            $tree,
                            $menu->menu_id,
                            $current_route
                        )
                    ) {

                        return true;

                    }

                }


                return false;

            }

        }

        if (!function_exists(
            'render_sidebar_menu'
        )) {

            function render_sidebar_menu(
                $tree,
                $parent_id = 0,
                $current_route = ''
            ) {

                if (
                    !isset(
                        $tree[$parent_id]
                    )
                ) {

                    return;

                }


                foreach (
                    $tree[$parent_id]
                    as $menu
                ) {

                    $has_sub =
                        isset(
                            $tree[
                                $menu->menu_id
                            ]
                        );

                    $has_parent_url =
                        !empty(
                            $menu->menu_url
                        );

                    $url =
                        $has_parent_url

                        ? base_url(
                            'index.php/' .
                            $menu->menu_url
                        )

                        : '#';

                    $menu_route =
                        strtolower(
                            trim(
                                (string)
                                $menu->menu_url,
                                '/'
                            )
                        );

                    $is_current = (

                        $menu_route !== '' &&

                        $current_route ===
                        $menu_route

                    );

                    if ($has_sub) {

                        $is_open = (

                            $is_current ||

                            sidebar_menu_has_active(
                                $tree,
                                $menu->menu_id,
                                $current_route
                            )

                        );

                        echo '<div class="has-submenu ' .
                            (
                                $is_open
                                ? 'menu-open'
                                : ''
                            ) .
                            '">';

                        echo '<div class="parent-menu-row">';

                        if ($has_parent_url) {

                            echo '<a
                                    href="' .
                                    $url .
                                    '"
                                    class="' .
                                    (
                                        $is_current
                                        ? 'active'
                                        : ''
                                    ) .
                                    '"
                                  >';

                            echo htmlspecialchars(
                                $menu->menu_name
                            );

                            echo '</a>';

                        }

                        else {

                            echo '<button
                                    type="button"
                                    class="parent-menu-button submenu-toggle-main"
                                  >';

                            echo htmlspecialchars(
                                $menu->menu_name
                            );

                            echo '</button>';

                        }

                        echo '<button
                                type="button"
                                class="submenu-toggle"
                                aria-label="Toggle submenu"
                              >';

                        echo '<span>▾</span>';

                        echo '</button>';


                        echo '</div>';

                        echo '<div class="submenu">';


                        render_sidebar_menu(
                            $tree,
                            $menu->menu_id,
                            $current_route
                        );


                        echo '</div>';


                        echo '</div>';

                    }

                    else {


                        echo '<a
                                href="' .
                                $url .
                                '"
                                class="' .
                                (
                                    $is_current
                                    ? 'active'
                                    : ''
                                ) .
                                '"
                              >';

                        echo htmlspecialchars(
                            $menu->menu_name
                        );

                        echo '</a>';

                    }

                }

            }

        }

        if (
            isset(
                $menu_tree[0]
            )
        ) {

            render_sidebar_menu(
                $menu_tree,
                0,
                $current_route
            );

        }

        elseif (
            isset(
                $menu_tree[null]
            )
        ) {

            render_sidebar_menu(
                $menu_tree,
                null,
                $current_route
            );

        }

        else {

            echo '
                <p class="text-gray-500 px-4 py-2">
                    No menus assigned.
                </p>
            ';

        }

        ?>

    </nav>

</aside>

<div class="flex-1 flex flex-col overflow-auto md:ml-[260px]">


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        document
            .querySelectorAll(
                '.submenu-toggle'
            )
            .forEach(
                function (button) {

                    button.addEventListener(
                        'click',
                        function (event) {


                            event.preventDefault();

                            event.stopPropagation();


                            const parent =
                                button.closest(
                                    '.has-submenu'
                                );


                            if (parent) {

                                parent.classList.toggle(
                                    'menu-open'
                                );

                            }

                        }
                    );

                }
            );

        document
            .querySelectorAll(
                '.submenu-toggle-main'
            )
            .forEach(
                function (button) {

                    button.addEventListener(
                        'click',
                        function (event) {


                            event.preventDefault();

                            event.stopPropagation();


                            const parent =
                                button.closest(
                                    '.has-submenu'
                                );


                            if (parent) {

                                parent.classList.toggle(
                                    'menu-open'
                                );

                            }

                        }
                    );

                }
            );

    }
);

</script>


