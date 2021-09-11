function subscribePopup() {
	let popup = document.getElementById('subscribe'),
		bell = document.getElementById('subscribe-bell');
	popup.classList.toggle('show');
	bell.classList.toggle('bell');
};

function closePopup(popupId) {
	let popup = document.getElementById(popupId),
		bell = document.getElementById('subscribe-bell');
	popup.classList.toggle('show');
	bell.classList.toggle('bell');
};

function addBodyPadding() {
	let header = document.getElementsByClassName('header')[0];
	document.body.style.paddingTop = header.offsetHeight + 'px';
	header.scrollTo(0, 0);
};

function toggle() {
	setTimeout(function () {
		let questionInput = document.getElementById('question').value,
			subscribeButton = document.getElementById('subscribe-btn');
		if (questionInput === 5 || questionInput === "5") {
			subscribeButton.style.backgroundColor = '';
			subscribeButton.style.color = '';
			subscribeButton.classList.add('btn--primary');
			subscribeButton.style.pointerEvents = 'all';
		} else {
			subscribeButton.style.backgroundColor = 'grey';
			subscribeButton.style.color = '#fff';
			subscribeButton.classList.remove('btn--primary');
			subscribeButton.style.pointerEvents = 'none';
		}
	}, 50);
};

function changeNav(scrollingDown) {
	let ribbon = document.getElementsByClassName('ribbon')[0],
		fontSize = window.getComputedStyle(ribbon, null).getPropertyValue('font-size');
	if (parseInt(fontSize) == 40) {
		if ((document.body.scrollTop != 0 || document.documentElement.scrollTop !== 0) && scrollingDown) {
			ribbon.style.opacity = 1;
			ribbon.style.display = "flex";
		} else {
			ribbon.style.opacity = 0;
			ribbon.style.display = "none";
		}
	}
};

let lastScrollTop = 0;
document.addEventListener('scroll', function () {
	let st = window.pageYOffset || document.documentElement.scrollTop;
	if (st > lastScrollTop) {
		changeNav(true);
	} else {
		changeNav(false);
	}
	lastScrollTop = st <= 0 ? 0 : st;
}, false);

document.addEventListener('DOMContentLoaded', function () {
	let popupTrigger = document.getElementsByClassName('section--2')[0];
	addBodyPadding();
	if (!document.getElementById('download-p')) {
		setTimeout(function () {
			let stocksPopup = document.getElementById('limited-stocks');
			stocksPopup.classList.add('show');
		}, 10000);
	} else if (document.getElementById('download-p')) {
		let popupCount = 0;
		let downloadBtns = document.getElementsByClassName('btnImage--download');
		for (downloadBtn of downloadBtns) {
			downloadBtn.addEventListener('click', function () {
				if ( popupCount == 0 ) {
					let stocksPopup = document.getElementById('limited-stocks');
					stocksPopup.classList.add('show');
					popupCount = 1;
				}
			});
		};
	}

});

window.addEventListener('resize', function () {
	addBodyPadding();
}, true);

document.addEventListener('DOMContentLoaded', function () {
	toggle();
});
