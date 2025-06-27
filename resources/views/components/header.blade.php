<flux:header container class="bg-white dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
    <!-- Left Section: Logo -->
    <div class="flex items-center">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
        <flux:brand href="/" logo="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIiIGhlaWdodD0iMzIiIHZpZXdCb3g9IjAgMCAzMiAzMiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTE2IDhDMTQuMzQzIDggMTMgOS4zNDMgMTMgMTFDMTMgMTIuNjU3IDE0LjM0MyAxNCAxNiAxNEMxNy42NTcgMTQgMTkgMTIuNjU3IDE5IDExQzE5IDkuMzQzIDE3LjY1NyA4IDE2IDhaIiBmaWxsPSIjMjU2M0VCIi8+CjxwYXRoIGQ9Ik0xNiA4VjdNMTYgOFYxNk0xNiAxNlYxN00xNiAxN0MxNC44OSAxNyAxMy45MiAxNi41OTggMTMuNDAxIDE1TTE2IDhDMTcuMTEgOCAxOC4wOCA4LjQwMiAxOC42IDE5TTE2IDhWN00xNiA4VjhNMTYgOFYxNk0xNiAxNlYxN00xNiAxN0MxNC44OSAxNyAxMy45MiAxNi41OTggMTMuNDAxIDE1TTE2IDhDMTcuMTEgOCAxOC4wOCA4LjQwMiAxOC42IDE5IiBzdHJva2U9IndoaXRlIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIvPgo8L3N2Zz4K" name="Gearu" class="max-lg:hidden dark:hidden" />
        <flux:brand href="/" logo="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIiIGhlaWdodD0iMzIiIHZpZXdCb3g9IjAgMCAzMiAzMiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTE2IDhDMTQuMzQzIDggMTMgOS4zNDMgMTMgMTFDMTMgMTIuNjU3IDE0LjM0MyAxNCAxNiAxNEMxNy42NTcgMTQgMTkgMTIuNjU3IDE5IDExQzE5IDkuMzQzIDE3LjY1NyA4IDE2IDhaIiBmaWxsPSIjMjU2M0VCIi8+CjxwYXRoIGQ9Ik0xNiA4VjdNMTYgOFYxNk0xNiAxNlYxN00xNiAxN0MxNC44OSAxNyAxMy45MiAxNi41OTggMTMuNDAxIDE1TTE2IDhDMTcuMTEgOCAxOC4wOCA4LjQwMiAxOC42IDE5TTE2IDhWN00xNiA4VjhNMTYgOFYxNk0xNiAxNlYxN00xNiAxN0MxNC44OSAxNyAxMy45MiAxNi41OTggMTMuNDAxIDE1TTE2IDhDMTcuMTEgOCAxOC4wOCA4LjQwMiAxOC42IDE5IiBzdHJva2U9IndoaXRlIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIvPgo8L3N2Zz4K" name="Gearu" class="max-lg:hidden! hidden dark:flex" />
    </div>

    <!-- Center Section: Navigation -->
    <div class="flex-1 flex justify-center">
        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item  href="/" current>Home</flux:navbar.item>
            <flux:navbar.item  href="/exchange-rates">Exchange Rates</flux:navbar.item>
            <flux:navbar.item  href="/blogs">Blogs</flux:navbar.item>
        </flux:navbar>
    </div>

    <!-- Right Section: Actions and Profile -->
    <div class="flex items-center space-x-4">
        <flux:navbar class="me-4">
            <flux:navbar.item icon="magnifying-glass" href="#" label="Search" />
            <flux:navbar.item class="max-lg:hidden" icon="cog-6-tooth" href="/settings" label="Settings" />
            <flux:navbar.item class="max-lg:hidden" icon="information-circle" href="/help" label="Help" />
        </flux:navbar>

        <flux:dropdown position="top" align="start">
            <flux:profile avatar="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIiIGhlaWdodD0iMzIiIHZpZXdCb3g9IjAgMCAzMiAzMiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMTYiIGN5PSIxNiIgcj0iMTYiIGZpbGw9IiM5Q0EzQUYiLz4KPHBhdGggZD0iTTE2IDhDMTMuNzkgOCAxMiA5Ljc5IDEyIDEyQzEyIDE0LjIxIDEzLjc5IDE2IDE2IDE2QzE4LjIxIDE2IDIwIDE0LjIxIDIwIDEyQzIwIDkuNzkgMTguMjEgOCAxNiA4WiIgZmlsbD0id2hpdGUiLz4KPHBhdGggZD0iTTggMjRDOCAxOS41ODIgMTEuNTgyIDE2IDE2IDE2QzIwLjQxOCAxNiAyNCAxOS41ODIgMjQgMjQiIGZpbGw9IndoaXRlIi8+Cjwvc3ZnPgo=" />

        <flux:menu>
            <flux:menu.item icon="user" href="/profile">Profile</flux:menu.item>
            <flux:menu.item icon="cog-6-tooth" href="/settings">Settings</flux:menu.item>
            <flux:menu.separator />
            <flux:menu.item icon="arrow-right-start-on-rectangle" href="/logout">Logout</flux:menu.item>
        </flux:menu>
    </flux:dropdown>
    </div>
</flux:header>

<flux:sidebar stashable sticky class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border rtl:border-r-0 rtl:border-l border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    <flux:brand href="/" logo="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIiIGhlaWdodD0iMzIiIHZpZXdCb3g9IjAgMCAzMiAzMiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTE2IDhDMTQuMzQzIDggMTMgOS4zNDMgMTMgMTFDMTMgMTIuNjU3IDE0LjM0MyAxNCAxNiAxNEMxNy42NTcgMTQgMTkgMTIuNjU3IDE5IDExQzE5IDkuMzQzIDE3LjY1NyA4IDE2IDhaIiBmaWxsPSIjMjU2M0VCIi8+CjxwYXRoIGQ9Ik0xNiA4VjdNMTYgOFYxNk0xNiAxNlYxN00xNiAxN0MxNC44OSAxNyAxMy45MiAxNi41OTggMTMuNDAxIDE1TTE2IDhDMTcuMTEgOCAxOC4wOCA4LjQwMiAxOC42IDE5TTE2IDhWN00xNiA4VjhNMTYgOFYxNk0xNiAxNlYxN00xNiAxN0MxNC44OSAxNyAxMy45MiAxNi41OTggMTMuNDAxIDE1TTE2IDhDMTcuMTEgOCAxOC4wOCA4LjQwMiAxOC42IDE5IiBzdHJva2U9IndoaXRlIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIvPgo8L3N2Zz4K" name="Gearu" class="px-2 dark:hidden" />
    <flux:brand href="/" logo="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIiIGhlaWdodD0iMzIiIHZpZXdCb3g9IjAgMCAzMiAzMiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTE2IDhDMTQuMzQzIDggMTMgOS4zNDMgMTMgMTFDMTMgMTIuNjU3IDE0LjM0MyAxNCAxNiAxNEMxNy42NTcgMTQgMTkgMTIuNjU3IDE5IDExQzE5IDkuMzQzIDE3LjY1NyA4IDE2IDhaIiBmaWxsPSIjMjU2M0VCIi8+CjxwYXRoIGQ9Ik0xNiA4VjdNMTYgOFYxNk0xNiAxNlYxN00xNiAxN0MxNC44OSAxNyAxMy45MiAxNi41OTggMTMuNDAxIDE1TTE2IDhDMTcuMTEgOCAxOC4wOCA4LjQwMiAxOC42IDE5TTE2IDhWN00xNiA4VjhNMTYgOFYxNk0xNiAxNlYxN00xNiAxN0MxNC44OSAxNyAxMy45MiAxNi41OTggMTMuNDAxIDE1TTE2IDhDMTcuMTEgOCAxOC4wOCA4LjQwMiAxOC42IDE5IiBzdHJva2U9IndoaXRlIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIvPgo8L3N2Zz4K" name="Gearu" class="px-2 hidden dark:flex" />

    <flux:navlist variant="outline">
        <flux:navlist.item icon="home" href="/" current>Home</flux:navlist.item>
        <flux:navlist.item icon="currency-dollar" href="/currencies">Currencies</flux:navlist.item>
        <flux:navlist.item icon="chart-bar" href="/exchange-rates">Exchange Rates</flux:navlist.item>
        <flux:navlist.item icon="cog-6-tooth" href="/admin">Admin</flux:navlist.item>
    </flux:navlist>

    <flux:spacer />

    <flux:navlist variant="outline">
        <flux:navlist.item icon="cog-6-tooth" href="/settings">Settings</flux:navlist.item>
        <flux:navlist.item icon="information-circle" href="/help">Help</flux:navlist.item>
    </flux:navlist>
</flux:sidebar>
